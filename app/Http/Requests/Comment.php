<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class Comment extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'text' => 'required|max:256|min:5'
        ];
    }

    public function attributes() {
        return [
            'text' => 'Содержимое'
        ];
    }

    public function checkCommentable() {
        $commantables = config('commentable');
        
        if(!isset($commantables[$this->model])) {
            Log::alert('Some moron try change model name, ip, model, etc');

            throw ValidationException::withMessages([
                'model' => 'wrong model',
            ]);
        }

        $model = $commantables[$this->model]::findOrFail($this->id);
        return $model;
    }
}
