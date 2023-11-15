@extends('layouts.main')

    @section('content')
    <div class="container">

        @if(isset($gift->id))
        <h2>Aqui fazes update da prenda {{$gift->name}}.</h2>
        @else
            <h2>Aqui adicionas novas prendas.</h2>
        @endif

        <form method="POST" action="{{route('gifts.store')}}">
            @csrf {{-- Token de validação para segurança do nosso formulário --}}

            <input type="hidden" name="id" value="{{isset($gift) ? $gift->id : null}}">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input name="name" value="{{isset($gift) ? $gift->name : ''}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                @error('name')
                        Por favor, coloque um nome da prenda.
                @enderror
                </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Estimated Cost</label>
                <input
                name="estimated_cost" value="{{isset($gift) ? $gift->estimated_cost : ''}}" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                @error('estimated_cost')
                        Por favor, coloque uma custo estimado.
                @enderror
            </div>
            @if(isset($gift->id))
            <div class="mb-3">
                <label for="time" class="form-label">Real Cost</label>
                <input name="real_cost" value="{{isset($gift) ? $gift->real_cost : ''}}" type="number" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input name="status" value="{{isset($gift) ? $gift->status : ''}}" type="number" class="form-control" id="exampleInputPassword1">
            </div>
            @endif

            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" required>
                    <option>Todos os Utilizadores</option>
                        @foreach ($users as $item)
                            <option @if($item->id == request()->query('user_id')) selected @endif value="{{$item -> id}}">
                                {{$item->name}}</option>
                        @endforeach
                </select>
                @error('user_id')
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
