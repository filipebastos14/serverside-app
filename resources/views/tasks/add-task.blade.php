@extends('layouts.main')

    @section('content')
    <div class="container">

        {{-- Este if é também para acomodarmos da melhor forma duas operações e podermos personalizá-las, uma vez que este form é usado para adicionar utilizadores e para atualizar utilizadores. --}}
        @if(isset($task->id))
        <h2>Aqui fazes update da tarefa {{$task->name}}.</h2>
        @else
            <h2>Aqui adicionas novas tarefas.</h2>
        @endif

        <form method="POST" action="{{route('tasks.store')}}"> {{-- É assim com este POST que fazemos com que os dados recebidos no frontend no formulário passe para o nosso projecto e a BD --}}
            @csrf {{-- Token de validação para segurança do nosso formulário --}}

            {{-- Este input é para enviarmos o id para o backend--}}
            <input type="hidden" name="id" value="{{isset($task) ? $task->id : null}}"> {{-- Isto serve para nos auxiliar mas não aparece no browser. Isto porque estamos a usar a mesma função para no browser vermos os utilizadores e criarmos utilizadores. Assim, usamos um operador ternário para saber como atuar nas duas situações.--}}

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input name="name" value="{{isset($task) ? $task->name : ''}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                @error('name') {{-- Mensagens de erro como esta são importantes para dar ao utilizador a informação de que algo falhou sem dar demasiada informação --}}
                        Por favor, coloque um nome da tarefa.
                @enderror
                </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Description</label>
                <input
                name="description" value="{{isset($task) ? $task->description : ''}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                @error('description') {{-- Mensagens de erro como esta são importantes para dar ao utilizador a informação de que algo falhou sem dar demasiada informação --}}
                        Por favor, coloque uma descrição.
                @enderror
            </div>

            @if(isset($task->id))
            <div class="mb-3">
                <label for="time" class="form-label">Due At</label>
                <input name="due_at" value="{{isset($user) ? $user->due_at : ''}}" type="date" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input name="status" value="{{isset($user) ? $user->status : ''}}" type="text" class="form-control" id="exampleInputPassword1">
            </div>
            @endif

            <div class="mb-3">
                <label for="user_id" class="form-label">User</label> {{-- Na linha de baixo usamos um operador ternário uma vez que estamos a usar duas vezes a blade new-user no UserController (new-user e view-user) --}}
                <select name="user_id" required>
                    <option>Todos os Utilizadores</option>
                        @foreach ($users as $item)
                            <option @if($item->id == request()->query('user_id')) selected @endif value="{{$item -> id}}">
                                {{$item->name}}</option>
                        @endforeach
                </select>
                {{-- <input name="user_id" value="{{isset($task) ? $task->user_id : ''}}" type="text" class="form-control" id="exampleInputPassword1" required> --}}
                @error('user_id') {{-- Mensagens de erro como esta são importantes para dar ao utilizador a informação de que algo falhou sem dar demasiada informação --}}
                        Por favor, escolha um utilizador a quem associar a tarefa.
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
        @if(session('message'))
        <div class="alert alert-sucess">{{session('message')}}</div>
        @endif
    </div>
    @endsection
