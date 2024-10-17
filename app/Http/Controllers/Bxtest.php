<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Bitrix24\BX24;

class Bxtest extends Controller
{
    public function index(Request $request)
    {

        $f_deal = $request->get('api_fields_deal');
        $f_contact = $request->get('api_fields_contract');
        $dealId = 531;

        $r_deal = dealFieldsValue($f_deal);
        $r_contract = contractFieldsValue(["test" => "3231"]);
        // $result = BX24::call(
        //     'crm.deal.get',
        //     [
        //         'id' => $dealId
        //     ]
        // );

        $selected_fields_contract = config('bitrix24selects.contract');


        $result = BX24::call(
            'crm.item.list',
            [
                'entityTypeId' => 181,
                'select' => $selected_fields_contract,
                'filter' => [
                    "parentId2" => $dealId
                ],
                'order' => [],
            ]
        )['result']['items'];

        // $result = $r_contract;

        return view('bxtest.bxtest', compact('result'));
    }
}
