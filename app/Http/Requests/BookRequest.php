<?php

namespace App\Http\Requests;

use App\Rules\Katakana;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'title' => 'bail|required|string|max:50',
            'price' => 'bail|required|numeric|min:0',
            'abstract' => 'bail|required|string',
            'tags' => 'bail|nullable|string',
        ];

        return $rules;
    }



    public function attributes() {
        return [
            'title' => 'タイトル',
            'price' => '価格',
            'abstract' => '概要',
            'tags' => 'タグ',
        ];
    }

}
