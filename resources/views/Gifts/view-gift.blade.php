@extends('layouts.main')

    @section('content')

    <div class="container">
        <h2>Aqui vês prendas</h2>

        <h6>Name: {{$gift->name}}</h6>
        <h6>Estimated Cost: {{$gift->estimated_cost}}</h6>
        <h6>Real Cost: {{$gift->real_cost}}</h6>
    </div>
    @endsection
