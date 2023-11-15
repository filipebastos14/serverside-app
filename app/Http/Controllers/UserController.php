<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getAllUsers(){
        $cesaeInfo = $this -> getCesaeInfo();
        $users = $this->allUsers();

        return view('users.all-users', compact(
            'cesaeInfo',
            'users'
    ));
    }

    public function addNewUser(){
        return view('users.new-user');
    }

    public function viewUser($id){ // Aqui estamos a passar um parâmetro para depois na view-user.blade podermos colocar corretamente as informações que serão visualizadas

        $user = DB::table('users')
            -> where('id', $id)
            -> first();

        return view('users.new-user', compact(
            'user'
        ));
    }

    public function deleteUser($id){

        DB::table('tasks') // Para também apagar a tarefa que estava associada ao utilizador que queremos apagar
        -> where('user_id', $id)
        -> delete();

        $user = DB::table('users')
        -> where('id', $id)
        -> delete();

        return back();
    }

    public function storeUser(Request $request){ // Aqui é também necessário adaptar, uma vez que usamos esta função para adicionar utilizadores e também para o update dos mesmos.
        // O if então vai diferenciar: se não existe um id, então estamos a criar um utilizador; se este existe, estamos então a atualizar um utilizador.

        if($request->id){
            // Este passo é uma validação de backend:
            $request->validate([
                'name' => 'string|max:50',
                'password' => 'min:6' //Aqui sem email, uma vez que não permitimos que o utilizador o altere quando faz update dos seus dados.
            ]);

            User::where('id', $request->id)
            -> update([
                'name' => $request -> name,
                'address'=> $request-> address,
                'password' => Hash::make($request->password)
            ]);
        }else{
            // Este passo é uma validação de backend:
            $request->validate([
                'name' => 'string|max:50',
                'email' =>'required|email|unique:users',
                'password' => 'min:6'
            ]);

            User::insert([
                'name' => $request -> name,
                'email'=> $request->email,
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()->route('users.all')->with('message', 'Contacto adicionado com sucesso.');
    }

    protected function getCesaeInfo(){
        $cesaeInfo = [
            'name' => 'Cesae',
            'address' => 'Rua Ciriaco Cardoso 186, 4150-212, Porto',
            'email' => 'cesae@cesae.pt',
        ];

        return $cesaeInfo;
    }

    protected function allUsers(){
        $users = db::table('users')
                ->get();

        return $users;
    }
}
