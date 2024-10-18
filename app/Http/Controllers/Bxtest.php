<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Bitrix24\BX24;

class Bxtest extends Controller
{
    public function index(Request $request)
    {
        $dealId = 531;

        // $result = BX24::call(
        //     'crm.deal.get',
        //     [
        //         'id' => $dealId
        //     ]
        // );

        $selec_fields_contract = config('bitrix24selects.contract_list');
        $selec_fields_deal = config('bitrix24selects.deal');

        $res_contract = BX24::call(
            'crm.item.list',
            [
                'entityTypeId' => 181,
                'select' => $selec_fields_contract,
                'filter' => [
                    "parentId2" => $dealId
                ],
                'order' => [],
            ]
        )['result']['items'];
        // dd($res_contract);
        // $r_deal = FieldsValue($f_deal, 'api_fields_deal');
        $r_contract = FieldsValue($res_contract, true);

        return view('bxtest.bxtest', compact('r_contract'));
    }

    public function show(string $id, Request $request)
    {

        $single_fields_contract = config('bitrix24selects.contract');
        $task_fields = config('bitrix24selects.task');

        dd($task_fields);

        $contract = BX24::call(
            'crm.item.get',
            [
                'entityTypeId' => 181,
                'id' => $id
            ]
        )['result']['item'];

        $con_fields = array_intersect_key($contract, array_flip($single_fields_contract));

        // dd($con_fields);

        $r_contract = FieldsValue($con_fields);

        // TO DO: take all fields? but we need only one
        $tasks = BX24::call(
            'tasks.task.list',
            [
                'select' => $task_fields,
                'filter' => [
                    'UF_CRM_TASK' => "Tb5_" . $id
                ],
            ]
        )['result']['tasks'];

        return  view('bxtest.singlecon', compact('r_contract', 'tasks'));
    }
}
