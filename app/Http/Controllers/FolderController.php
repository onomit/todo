<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFolder; // ★追加
use App\Models\Folder;  

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }
    
    public function create(CreateFolder $request) // ★引数の型を Request → CreateFolderへ変更
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->title = $request->title;
        // インスタンスの状態をデータベースに書き込む
        $folder->save();

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
    
    public function showEditForm(int $id)
    {
        $folder = Folder::find($id);

        return view('folders/edit', ['folder' => $folder,]);
    }
}
