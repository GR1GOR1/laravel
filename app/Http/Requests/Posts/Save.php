<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class Save extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|unique:posts|max:25|min:5',
            'content' => 'required|max:255|min:5'
        ];
    }

    public function attributes() {
        return [
            'title' => 'Zagolovok',
            'content' => 'Контент'
        ];
    }
}
