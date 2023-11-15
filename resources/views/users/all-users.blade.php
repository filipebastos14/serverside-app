@extends('layouts.main')

    <div class="container">
    @section('content')
    <h2>Olá, sou todos os utilizadores</h2>


    <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Morada</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->password }}</td>
                        <td><a href="{{route('users.view-user', $user->id)}}" class="btn btn-info">Ver</a> {{-- Aqui coloca-se uma rota com o parâmetro --}}
                            <a href="{{route('users.delete-user', $user->id)}}" class="btn btn-danger">Apagar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
