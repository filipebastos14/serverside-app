@extends('layouts.main')

    @section('content')

    <div class="container">
        <h5>Tasks</h5>
        <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Estado</th>
                <th scope="col">Data de conclusão</th>
                <th scope="col">Nome do Responsável</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                    @foreach ($tasks as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->due_at }}</td>
                        <td>{{ $item->resname}}</td>
                        <td><a href="{{route('tasks.view-task', $item->id)}}" class="btn btn-info">Ver | Editar</a> {{-- Aqui coloca-se uma rota com o parâmetro --}}
                            <a href="{{route('tasks.delete-task', $item->id)}}" class="btn btn-danger">Apagar</a>
                        </td>
                    @endforeach
                </tr>
                </tr>
            </tbody>
          </table>
            <table>
            </table>
    </div>
    @endsection

