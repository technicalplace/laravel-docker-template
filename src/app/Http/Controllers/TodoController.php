<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todo = new Todo();
        $todos = $todo->all();

        return view('todo.index', ['todos' => $todos]);
    }

    public function create()
    {
        return view('todo.create');
    }

    /** todo新規作成処理 */
    public function store(Request $request)
    {
        $inputs = $request->all();

        // 1. todosテーブルの1レコードを表すTodoクラスをインスタンス化
        $todo = new Todo();
        // 2. Todoインスタンスのカラム名のプロパティに保存したい値を代入
        $todo->fill($inputs);
        // 3. Todoインスタンスの`->save()`を実行してオブジェクトの状態をDBに保存するINSERT文を実行
        $todo->save();

        // リダイレクト処理
        return redirect()->route('todo.index');
    }

    /** todo詳細表示処理 */
    public function show($id)
    {
        $model = new Todo();
        $todo = $model->find($id);

        return view('todo.show', ['todo' => $todo]);
    }
}
