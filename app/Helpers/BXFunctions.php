<?php

use Illuminate\Support\Facades\Request;

function dowork($inputArray, $fields_list) {
    foreach ($inputArray as $k => $contract) {
            $buffer = $fields_list[$k];
            if ($buffer['type'] == 'enumeration') {
                if ($buffer['isMultiple'] == false) {
                    foreach ($buffer['items'] as $elem) {
                        if ($elem['ID'] == $inputArray[$k]) {
                            $inputArray[$k] = [
                                "title" => $buffer['title'],
                                "value" => $elem['VALUE']
                            ];
                        }
                    }
                }
            } else {
                $inputArray[$k] = [
                    "title" => $buffer['title'],
                    "value" => $inputArray[$k]
                ];
            }
    }

    return $inputArray;
}

if (!function_exists('FieldsValue')) {
    function FieldsValue(array $inputArray, bool $multi = false ,string $api = 'api_fields_contract')
    {
        $fields_list = Request::get($api);

        if ($multi)
            foreach ($inputArray as $k => $contract) {
                $inputArray[$k] = dowork($contract,$fields_list);
            }
        else 
            $inputArray = dowork($inputArray, $fields_list);

        return $inputArray;
    }
}
