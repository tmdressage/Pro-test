<?php

namespace App\Imports;

use App\Models\Shop;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\CustomException;

class CsvImport implements ToCollection, WithStartRow, SkipsEmptyRows //空行はスキップして取り込む
{
    public static $startRow = 2;       //CSVファイルの1行目はヘッダとして2行目から取り込む

    public function collection(Collection $rows)
    {
        if ($rows->isEmpty()) {
            throw new CustomException('CSVファイルに店舗情報のデータが含まれていません。');
        }//app/Exceptions/CustomException.phpとHandler.phpで別途の例外処理を実行
        
        Validator::make(
            $rows->toArray(),
            [
                '*.0' => ['required', 'string', 'max:50'],
                '*.1' => ['required', 'url', 'regex:/\.(jpeg|png)$/i'],
                //画像ではなくURLの文字で判別するためimageやmimesが使えず、正規表現で代用した
                '*.2' => ['required', 'in:東京都,大阪府,福岡県'],
                '*.3' => ['required', 'in:寿司,焼肉,イタリアン,居酒屋,ラーメン'],
                '*.4' => ['required', 'string', 'max:400'],
            ],
            [
                '*.0.required' => '! 店舗名を入力してください。',
                '*.0.string' => '! 店舗名を文字列で入力してください。',
                '*.0.max' => '! 店舗名を50文字以内で入力してください。',
                '*.1.required' => '! 店舗画像のURLを入力してください。',
                '*.1.url' => '! 店舗画像はURL形式で入力してください。',
                '*.1.regex' => '! jpegまたはpng形式の店舗画像のURLを入力してください。',
                '*.2.required' => '! エリアを入力してください。',
                '*.2.in' => '! エリアは東京都、大阪府、福岡県のいずれかを入力してください。',
                '*.3.required' => '! ジャンルを入力してください。',
                '*.3.in' => '! ジャンルは寿司、焼肉、イタリアン、居酒屋、ラーメンのいずれかを入力してください。',
                '*.4.required' => '! 店舗概要を入力してください。',
                '*.4.string' => '! 店舗概要を文字列で入力してください。',
                '*.4.max' => '! 店舗概要を400文字以内で入力してください。',
            ]
        )->validate();

        foreach ($rows as $row) {
            Shop::create([
                'shop_name' => $row[0], // 行の1列目
                'shop_img'  => $row[1], // 行の2列目
                'shop_area' => $row[2], // 行の3列目
                'shop_genre' => $row[3], // 行の4列目
                'shop_text'  => $row[4], // 行の5列目
            ]);
        }

    }

    /**
     * @return int
     */

    public function startRow(): int
    {
        return self::$startRow;
    }
    
}
