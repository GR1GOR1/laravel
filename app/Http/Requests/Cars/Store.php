<?php

namespace App\Http\Requests\Cars;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Car;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $transmissions = config('app-cars.transmissions');

        return [
            'brand' => 'required|max:64|min:2',
            'model' => 'required|max:64|min:2',
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
            'brand' => 'Марка',
            'model' => 'Модель',
            'vin' => 'VIN',
            'transmission' => 'Коробка передач'
        ];
    }

    protected function vinUniqueRule() {
        return Rule::unique(Car::class, 'vin');
    }
}
