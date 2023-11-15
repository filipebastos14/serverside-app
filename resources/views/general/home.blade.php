@extends('layouts.main')

    @section('content')
        <h2>Cheguei a casa</h2>
        <ul>
        <a href="{{route('users.all')}}"><li>Todos os utilizadores</li></a>
        <a href="{{route ('users.new-user')}}"><li>Adicionar Utilizador</li></a>
        <a href="{{route ('tasks.all-tasks')}}"><li>Todas as tarefas</li></a>
        </ul>
        {{--{{$hello}}--}}

        <ul>
        @foreach ($weekDays as $day)
            <li>{{$day}}</li>
        @endforeach
    </ul>

    <div>
        <h5>Users</h5>
        <table>
        @foreach ($users as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
        </tr>
        @endforeach
    </table>


    {{-- Exemplo de uma apresentação de dados de um user --}}
        {{--<h4>Dados do Pedro</h4>
        <h6>{{$user->name}}</h6>
        <h6>{{$user->password}}</h6>--}}
    </div>
    @endsection
