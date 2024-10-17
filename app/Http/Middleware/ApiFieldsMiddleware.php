<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Bitrix24\BX24;
use Illuminate\Support\Facades\Cache;

class ApiFieldsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $fields_contract = Cache::remember(
            'api_fields1', 60, function () {
                $response = BX24::call('crm.item.fields', ['entityTypeId' => 181]);
                
                if (!isset($response['result'])) {
                    return ["Ответ" => "False"]; // Возвращаем пустой массив в случае ошибки
                }
                
                return $response['result']['fields'];
            }
        );

        $fields_deal = Cache::remember(
            'api_fields2', 60, function () {
                $response = BX24::call('crm.deal.fields', []);
                
                if (!isset($response['result'])) {
                    return ["Ответ" => "False"]; // Возвращаем пустой массив в случае ошибки
                }
                
                return $response['result'];
            }
        );

        $request->attributes->set('api_fields_contract', $fields_contract);
        $request->attributes->set('api_fields_deal', $fields_deal);

        return $next($request);
    }
}
