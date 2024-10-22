<?php

use Illuminate\Support\Facades\Request;
use JBBCode\Parser;
use JBBCode\CodeDefinitionBuilder;

if (!function_exists('parseBB')) {
    function parseBB($val)
    {
        $parser = new Parser();

        $parser->addCodeDefinitionSet(new \JBBCode\DefaultCodeDefinitionSet());

        $fontBuilder = new CodeDefinitionBuilder('font', '<span style="font-family:{option}">{param}</span>');
        $fontBuilder->setUseOption(true);
        $parser->addCodeDefinition($fontBuilder->build());

        $sizeBuilder = new CodeDefinitionBuilder('size', '<span style="font-size:{option}">{param}</span>');
        $sizeBuilder->setUseOption(true);
        $parser->addCodeDefinition($sizeBuilder->build());

        $codeBuilder = new CodeDefinitionBuilder('code', '<br><pre style="background: black; border-radius:10px; padding: 5px;"><code style="color: white;">{param}</code></pre><br>');
        $parser->addCodeDefinition($codeBuilder->build());

        $parser->parse($val);

        $htmlText = $parser->getAsHtml();
        return $htmlText;
    }
}
if (!function_exists('FieldsValue')) {
    function dowork($inputArray, $fields_list)
    {
        foreach ($inputArray as $k => $value) {
            if (isset($fields_list[$k])) {
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
                } else if ($buffer['type'] == 'enum') {
                    foreach ($buffer['values'] as $key_enum => $elem) {
                        if ($key_enum == $inputArray[$k]) {
                            $inputArray[$k] = [
                                "title" => $buffer['title'],
                                "value" => $elem
                            ];
                        }
                    }
                } else if ($buffer['type'] == 'datetime') {
                    if ($inputArray[$k]) {
                        $date = new DateTime($inputArray[$k]);
                        $formattedDate = $date->format('d.m.Y');
                        $inputArray[$k] = [
                            "title" => $buffer['title'],
                            "value" => $formattedDate
                        ];
                    }
                } else {
                    $inputArray[$k] = [
                        "title" => $buffer['title'],
                        "value" => $inputArray[$k]
                    ];
                }
            }
        }

        return $inputArray;
    }
}
if (!function_exists('FieldsValue')) {
    function FieldsValue(array $inputArray, bool $multi = false, string $api = 'api_fields_contract')
    {
        $fields_list = Request::get($api);

        if ($multi)
            foreach ($inputArray as $k => $value) {
                $inputArray[$k] = dowork($value, $fields_list);
            }
        else
            $inputArray = dowork($inputArray, $fields_list);

        return $inputArray;
    }
}
