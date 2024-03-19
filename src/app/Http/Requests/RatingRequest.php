<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
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
            'rating' => ['required'],
            'text' => ['max:400'], //口コミは任意
            'image' => ['image', 'mimes:jpeg,png']//画像は任意
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '! 評価を星１～５のいずれかで選択してください。',
            'text.max' => '! 口コミは400字以内で入力してください。',
            'image.image' => '! 画像ファイルをアップロードしてください。',
            'image.mimes' => '! jpegまたはpng形式の画像ファイルをアップロードしてください。',
        ];
    }
}
