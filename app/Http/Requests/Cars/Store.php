<?php

namespace App\Http\Requests\Cars;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Car;

class Store extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $transmissions = config('app-cars.transmissions');

        return [
            'brand_id' => 'required|exists:brands,id',
            'model' => 'required|max:64|min:2',
            'tags' => 'array',
            'tags.*' => 'integer|exists:tags,id',
            // 'vin' => 'required|max:64|min:2|unique:cars,vin',
            // 'vin' => ['required', 'max:64', 'min:2', Rule::unique(Car::class, 'vin')->ignore($this->car)],
            'vin' => ['required', 'max:64', 'min:2', $this->vinUniqueRule() ],
            'transmission' => [
                'required',
                'integer',
                Rule::in(array_keys($transmissions))
            ]
        ];
    }

    public function attributes() {
        return [
            'brand_id' => 'Марка',
            'model' => 'Модель',
            'vin' => 'VIN',
            'transmission' => 'Коробка передач',
            'tags' => 'Теги'
        ];
    }

    protected function vinUniqueRule() {
        return Rule::unique(Car::class, 'vin')->whereNull('deleted_at');
        // return Rule::unique(Car::class, 'vin');
    }
}
