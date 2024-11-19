<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function index()
    {
        $todos = $this->todo->all();

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

        // 1. Todoインスタンスのカラム名のプロパティに保存したい値を代入
        $this->todo->fill($inputs);
        // 2. Todoインスタンスの`->save()`を実行してオブジェクトの状態をDBに保存するINSERT文を実行
        $this->todo->save();

        // リダイレクト処理
        return redirect()->route('todo.index');
    }

    /** todo詳細表示処理 */
    public function show($id)
    {
        $todo = $this->todo->find($id);

        return view('todo.show', ['todo' => $todo]);
    }

    /** todo編集機能 */
    public function edit($id)
    {
        $todo = $this->todo->find($id);

        return view('todo.edit', ['todo' => $todo]);
    }

    /** todo更新処理 */
    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        $todo = $this->todo->find($id);
        $todo->fill($inputs)->save();

        return redirect()->route('todo.show', $todo->id);
    }
}
