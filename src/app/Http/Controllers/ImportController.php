<?php

namespace App\Http\Controllers;
use App\Imports\CsvImport;
use App\Http\Requests\ImportRequest;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Illuminate\Support\Facades\Log;

class ImportController extends Controller
{
    public function getImport()
    {
        
        return view('admin.import', ['error' => '']);
    }

    public function postImport(ImportRequest $request)
    {        
        // アップロードされたCSVファイル
        $file = $request->file('file');
 
 
        try {
            $import = new CsvImport();
            Excel::import($import, $file);
            //app/Imports/CsvImport.phpで処理を実行

        } catch (ValidationException $th) {
            Log::alert($th->errors());
            return redirect('import')->with('error', '予期せぬエラーが発生しました');
        }
        
        return redirect('import')->with('result', 'CSVファイルのインポートが完了しました');
    }
}
