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


        $contract = BX24::call(
            'crm.item.get',
            [
                'entityTypeId' => 181,
                'id' => $id
            ]
        )['result']['item'];

        $con_fields = array_intersect_key($contract, array_flip($single_fields_contract));

        $r_contract = FieldsValue($con_fields);

        $tasks = BX24::call(
            'tasks.task.list',
            [
                'select' => $task_fields,
                'filter' => [
                    'UF_CRM_TASK' => 'Tb5_' . $id,
                    'UF_AUTO_848556474336' => true
                ],
            ]
        )['result']['tasks'];

        // dd($r_contract);
        $r_task = FieldsValue($tasks, true, 'api_fields_task');

        foreach ($r_task as $key => $tsk) {
            $restsk = BX24::call(
                'tasks.task.result.list',
                [
                    'taskId' => $tsk['id']['value'],
                ]
            )['result'];

            if (isset($restsk[0])) {
                $r_task[$key]["resanswer"] = $restsk[0];

                if (isset($r_task[$key]['descriptionInBbcode']) && $r_task[$key]['descriptionInBbcode'] == "Y") {
                    $r_task[$key]["resanswer"] = parseBB($restsk[0]["text"]);
                    $r_task[$key]["description"]["value"] = parseBB($r_task[$key]["description"]["value"]);
                }
            } else {
                if (isset($r_task[$key]['descriptionInBbcode']) && $r_task[$key]['descriptionInBbcode'] == "Y") {
                    $r_task[$key]["description"]["value"] = parseBB($r_task[$key]["description"]["value"]);
                }
            }
            
            
            $checklist = BX24::call(
                'task.checklistitem.getlist',
                [
                    'taskId' => $tsk['id']['value'],
                ]
            )['result'];

            if (isset($checklist[0])) {
                $title = $checklist[0]["TITLE"];
                unset($checklist[0]);
    
                $r_task[$key]["cheklist"][$title] = $checklist;
            }


            // dd($r_task);
        }

        return  view('bxtest.singlecon', compact('r_contract', 'r_task'));
    }

}
