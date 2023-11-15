@extends('layouts.main')

    @section('content')

    <div class="container">
        <h2>Aqui vês tarefas</h2>

        {{-- Só conseguimos fazer isto assim porque no UserController, na função viewUser($id) fiz a query à base de dados com o id que passei na route (web.php) --}}

        <h6>Name: {{$task->name}}</h6>
        <h6>Description: {{$task->description}}</h6>
        <h6>Due date: {{$task->due_at}}</h6>
        <h6>Pessoa responsável: {{$task->resname}}</h6>
    </div>
    @endsection
