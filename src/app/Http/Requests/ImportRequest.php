<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'file' => ['required', 'mimes:csv,txt', 'max:1024'],
        ];
    }

    public function messages()
    {
        return [
            'file.required' => '! CSVファイルが選択されていません。',
            'file.mimes' => '! CSV形式のファイルを選択してください。',
            'file.max' => '! CSVファイルのサイズが大きすぎます。',
        ];
    }
}
