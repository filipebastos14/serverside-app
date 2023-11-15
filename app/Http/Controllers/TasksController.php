<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function getAllTasks(){

        $tasks = $this -> allTasks();

        $tasksFromModel = Task::all(); // Isto é feito usando o Model (criando um modelo, podemos aceder à tabela respetiva sem necessidade de fazer queries como temos na função allTasks.)
        // Chamar assim um modelo com Task::all(); é utilizar uma query do Modelo.

        return view("tasks.tasks", compact(
            'tasks'
        ));
    }

    public function viewTask($id){ // Aqui estamos a passar um parâmetro para depois na view-user.blade podermos colocar corretamente as informações que serão visualizadas

        $task = DB::table('tasks')
            -> where('tasks.id', $id)
            -> join('users', 'users.id', '=', 'tasks.user_id')
            -> select('tasks.*', 'users.name AS resname')
            -> first();

            $users = $this->allUsers();

        return view('tasks.add-task', compact(
            'task',
            'users'
        ));
    }

    public function addNewTask(){
        $users = $this->allUsers();

        //$users = DB::table('users')->get(); Isto é o mesmo que a linha acima

        return view('tasks.add-task', compact(
            'users'
        ));
    }

    public function deleteTask($id){

        DB::table('tasks') // Para também apagar a tarefa que estava associada ao utilizador que queremos apagar
        -> where('id', $id)
        -> delete();

        return back();
    }

    protected function allTasks(){
        $tasks = DB::table('tasks') // Aqui poderia estar $tasks = Task:: join ... - e isto é a mesma coisa que fazer a query como temos neste exemplo.
        -> join('users', 'users.id', '=', 'tasks.user_id')
        -> select('tasks.*', 'users.name AS resname')
        ->get();

        return $tasks;
    }

    public function storeTask(Request $request){
        if($request->id){
            $request->validate([
                'name' => 'string|max:50',
                'description' =>'string|required',
                'user_id' => 'required'
            ]);

            Task::where('id', $request->id)
            -> update([
                'name' => $request->name,
                'description'=> $request->description,
                'user_id' => $request->user_id,
                'due_at' =>$request->due_at,
                "status" =>$request->status
            ]);
        }else{
            $request->validate([
                'name' => 'string|max:50',
                'description' =>'string|required',
                'user_id' => 'required'
            ]);

            DB::table('tasks')-> insert([
                'name' => $request->name,
                'description'=> $request->description,
                'user_id' =>$request->user_id,
            ]);
        }

        return redirect()->route('tasks.all-tasks')->with('message', 'Tarefa adicionada com sucesso.');
    }

    protected function allUsers(){
        $users = db::table('users')
                ->get();

        return $users;
    }
}
