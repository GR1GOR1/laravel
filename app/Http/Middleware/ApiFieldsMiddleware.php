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

        $fields_task = Cache::remember(
            'api_fields3', 60, function () {
                $response = BX24::call('tasks.task.getFields',[]);
                
                if (!isset($response['result'])) {
                    return ["Ответ" => "False"]; // Возвращаем пустой массив в случае ошибки
                }
                
                foreach ($response['result']['fields'] as $key =>  $value) {
                    $string = strtolower($key);
                    $parts = explode('_', $string);
                    $parts = array_map(function($part, $index) {
                        return $index == 0 ? $part : ucfirst($part);
                    }, $parts, array_keys($parts));

                    $response['result']['fields'][implode('', $parts)] = $response['result']['fields'][$key];
                    unset($response['result']['fields'][$key]);
                }
                return $response['result']['fields'];
            }
        );

        $request->attributes->set('api_fields_contract', $fields_contract);
        $request->attributes->set('api_fields_deal', $fields_deal);
        $request->attributes->set('api_fields_task', $fields_task);

        return $next($request);
    }
}
