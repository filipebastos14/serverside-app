@extends('layouts.main')

    @section('content')

    <div class="container">
        <h2>Aqui vês utilizadores</h2>

        {{-- Só conseguimos fazer isto assim porque no UserController, na função viewUser($id) fiz a query à base de dados com o id que passei na route (web.php) --}}
        <h6>Name: {{$user->name}}</h6>
        <h6>Address: {{$user->address}}</h6>
        <h6>Password: {{$user->password}}</h6>
    </div>
    @endsection
