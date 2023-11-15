<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function getMain(){
        $hello = 'Hello World!';

        $weekDays = ['Segunda', 'Terça', 'Quarta'];

        $users = $this -> getAllUsers(); // É desta forma que podemos chamar uma função para a assignar a uma variável

        //dd($users);

        $user = DB::table('users') // FAZER UMA QUERY ATRAVÉS DE CÓDIGO
        -> where('id', 1)
        -> first(); //UM FIRST RETORNA UM OBJECTO; UM GET RETORNA UMA ARRAY COM OBJECTOS

        //dd($user);

        //dd($weekDays); Dump and die (para consultar o que estamos a receber na variável na página web)

        return view('general.home', compact(
            'hello',
            'weekDays',
            'user',
            'users'
        ));
    }

    protected function getAllUsers(){
        $users = DB::table('users') // FAZER UMA QUERY ATRAVÉS DE CÓDIGO, USANDO UMA FUNÇÃO
        //-> where('id', 2)
        -> get();

        return $users;
    }
}
