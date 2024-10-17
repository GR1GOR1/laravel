<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('contractFieldsValue')) {
    function contractFieldsValue(array $inputArray) {
        // Получаем массив 1 из middleware или другого источника
        $fields1 = Request::get('api_fields_contract');

        // Логика обработки переданного массива и массива 1
        return array_merge($inputArray, $fields1); // Пример: объединяем два массива
    }
}

if (!function_exists('dealFieldsValue')) {
    function dealFieldsValue(array $inputArray) {
        // Получаем массив 2 из middleware или другого источника
        $fields2 = Request::get('api_fields_deal');

        // Логика обработки переданного массива и массива 2
        return array_merge($inputArray, $fields2); // Пример: объединяем два массива
    }
}
