@extends('layouts.main')

    @section('content')
    <div class="container">

        {{-- Este if é também para acomodarmos da melhor forma duas operações e podermos personalizá-las, uma vez que este form é usado para adicionar utilizadores e para atualizar utilizadores. --}}
        @if(isset($user))
        <h2>Aqui fazes update do utilizador {{$user->name}}.</h2>
        @else
            <h2>Aqui adicionas novos utilizadores.</h2>
        @endif

        <form method="POST" action="{{route('users.store')}}"> {{-- É assim com este POST que fazemos com que os dados recebidos no frontend no formulário passe para o nosso projecto e a BD --}}
            @csrf {{-- Token de validação para segurança do nosso formulário --}}

            <input type="hidden" name="id" value="{{isset($user) ? $user->id : null}}"> {{-- Isto serve para nos auxiliar mas não aparece no browser. Isto porque estamos a usar a mesma função para no browser vermos os utilizadores e criarmos utilizadores. Assim, usamos um operador ternário para saber como atuar nas duas situações.--}}
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input name="name" value="{{isset($user) ? $user->name : ''}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                @error('name') {{-- Mensagens de erro como esta são importantes para dar ao utilizador a informação de que algo falhou sem dar demasiada informação --}}
                        Por favor, coloque um nome.
                @enderror
                </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input
                @if (isset($user))
                disabled {{-- Isto serve para quando estamos a fazer um update o campo do email bloquear: não devemos permitir um utilizador mudar o email no registo anteriormente criado. --}}
                @endif
                name="email" value="{{isset($user) ? $user->email : ''}}" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                @error('email') {{-- Mensagens de erro como esta são importantes para dar ao utilizador a informação de que algo falhou sem dar demasiada informação --}}
                        Por favor, coloque um email.
                @enderror
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label> {{-- Na linha de baixo usamos um operador ternário uma vez que estamos a usar duas vezes a blade new-user no UserController (new-user e view-user) --}}
                <input name="password" value="{{isset($user) ? $user->password : ''}}" type="password" class="form-control" id="exampleInputPassword1" required>
                @error('password') {{-- Mensagens de erro como esta são importantes para dar ao utilizador a informação de que algo falhou sem dar demasiada informação --}}
                        Por favor, coloque uma password com pelo menos 8 caracteres.
                @enderror
            </div>
            <div>
            @if(isset($user)) {{-- Para que o utilizador possa adicionar morada, caso seja um utilizador a fazer update dos dados (não deve surgir ao novo registo) --}}
            <div class="mb-3">
                <label for="address" class="form-label">Morada</label>
                <input name="address" value="{{isset($user) ? $user->address : ''}}" type="text" class="form-control" id="exampleInputPassword1">
            </div>
            
            @endif
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        @if(session('message'))
        <div class="alert alert-sucess">{{session('message')}}</div>
        @endif
    </div>
    @endsection

