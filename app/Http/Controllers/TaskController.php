<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Task;

class TaskController extends Controller
{
    //
    public function update(Request $request){
        $task = Task::findOrFail($request->taskId);
        if( !$task ){
            return ['success' => false];
        }
        $task->is_done = $request->status;
        $task->save();
        // dd($task);

        return ['success' => true];
    }


    public function index(){

    }

    public function create(Request $request){
        $categories = Category::all();
        $data = [];
        $data['categories'] = $categories;

        return view('tasks.create', $data);
    }

    public function create_action(Request $request){
        $task = $request->only(['title', 'category_id','description','due_date']);

        $task['user_id'] = 1;
        $dbTask = Task::create($task);

        return redirect(route('home'));
        //return $dbTask;  //Visualizar o vetor de informação puro
        //dd($request->all());             //DD (Dump and Die) é uma função no Laravel que permite exibir informações de depuração durante o desenvolvimento de um aplicativo. É usado para exibir o conteúdo de variáveis, objetos ou arrays para ajudar os desenvolvedores a entenderem o estado do aplicativo em um determinado ponto do código.
    }

    public function edit(Request $request){
        $id = $request->id;

        $task = Task::find($id);
        if( !$task ){
            return redirect(route('home'));
        }
        $categories = Category::all();
        $data['categories'] = $categories;

        $data['task'] = $task;

        // dd($id); // Imprime o valor de id no método dump and die
        return view('tasks.edit', $data);
    }


    public function edit_action(Request $request) {

        // array:6 [▼ // app\Http\Controllers\TaskController.php:53
        // "_token" => "e6y03qkUYrqVCgZQfFPTSLZz8ZeAgC20EAlhf7Vs"
        // "id" => "1"
        // "title" => "Teste sistema"
        // "due_date" => "1996-06-27T19:14:11"
        // "category_id" => "25"
        // "description" => "Eveniet debitis debitis at itaque."
        // ]

        //dd($request->all());

        $request_data = $request->only(['title','due_date','category_id','description']);

        $request_data['is_done'] = $request->is_done ? true : false;
        //dd($request_data);

        $task = Task::find($request->id);
        if( !$task ){
            return 'Erro de task não existente';
        }

        $task->update($request_data);
        $task->save();

        //dd($task);
        return redirect(route('home'));
    }

    public function delete(Request $request) {

        $id = $request->id;

        $task = Task::find($id);

        if($task) {
            $task->delete();
        }

        return redirect(route('home'));
    }
}
