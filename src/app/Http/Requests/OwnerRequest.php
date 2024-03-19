<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnerRequest extends FormRequest
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
            'shop_name' => ['required', 'string', 'max:50'],
            'shop_img' => ['required'],
            'shop_area' => ['required'],
            'shop_genre' => ['required'],
            'shop_text' => ['required', 'string', 'max:400'],
        ];
    }

    public function messages()
    {
        return [
            'shop_name.required' => '! 店舗名を入力してください。',
            'shop_name.string' => '! 店舗名を文字列で入力してください。',
            'shop_name.max' => '! 店舗名を50文字以内で入力してください。',
            'shop_img.required' => '! 画像をアップロードしてください。',
            'shop_area.required' => '! エリアを入力してください。',
            'shop_genre.required' => '! ジャンルを入力してください。',
            'shop_text.required' => '! 店舗概要を入力してください。',
            'shop_text.string' => '! 店舗概要を文字列で入力してください。',
            'shop_text.max' => '! 店舗概要を400文字以内で入力してください。',

        ];
    }
}
