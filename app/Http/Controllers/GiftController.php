<?php

namespace App\Http\Controllers;
use App\Models\Gift;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GiftController extends Controller
{
    // Para ir buscar todas as entradas da tabela Gifts
    public function getAllGifts(){

        $gifts = DB::table('gifts')
        -> join('users', 'users.id', '=', 'gifts.user_id')
        -> select('gifts.*', 'users.name AS resname')
        ->get();


        $costDiff = 0;

        foreach($gifts as $gift){
            if($gift->real_cost != 0){
                $gift->costDiff = $gift->estimated_cost - $gift->real_cost;
            } else{
                $gift->costDiff = 0;
            }
        }

        return view("gifts.all-gifts", compact(
            'gifts',
            'costDiff'
        ));
    }

    // Para ir buscar uma entrada da tabela
    public function viewGift($id){

        $gift = DB::table('gifts')
            -> where('gifts.id', $id)
            -> join('users', 'users.id', '=', 'gifts.user_id')
            -> select('gifts.*', 'users.name AS resname')
            -> first();

            $users = $this->allUsers();

        return view('gifts.add-gift', compact(
            'gift',
            'users'
        ));
    }

    // Para adicionar entrada na tabela Gifts
    public function addNewGift(){
        $users = $this->allUsers();

        return view('gifts.add-gift', compact(
            'users'
        ));
    }

    // Para fazer o insert e update na tabela Gifts
    public function storeGift(Request $request){
        if($request->id){
            $request->validate([
                'name' => 'string|max:50',
                'estimated_cost' =>'int|required',
                'user_id' => 'required'
            ]);

            Gift::where('id', $request->id)
            -> update([
                'name' => $request->name,
                'estimated_cost'=> $request->estimated_cost,
                'real_cost'=> $request->real_cost,
                "status" =>$request->status,
                'user_id' => $request->user_id,
            ]);
        }else{
            $request->validate([
                'name' => 'string|max:50',
                'estimated_cost' =>'int|required',
                'user_id' => 'required'
            ]);

            DB::table('gifts')-> insert([
                'name' => $request->name,
                'estimated_cost'=> $request->estimated_cost,
                'user_id' =>$request->user_id,
            ]);
        }

        return redirect()->route('gifts.all-gifts')->with('message', 'Presente adicionado com sucesso.');
    }


    // Para aceder à tabela dos users
    protected function allUsers(){
        $users = db::table('users')
                ->get();

        return $users;
    }
}
