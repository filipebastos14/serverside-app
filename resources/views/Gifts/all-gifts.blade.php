@extends('layouts.main')

    @section('content')

    <div class="container">
        <h5>Gifts</h5>
        <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th scope="col">Name</th>
                <th scope="col">Estimated Cost</th>
                <th scope="col">Real Cost</th>
                <th scope="col">Status</th>
                <th scope="col">Assigned to</th>
                <th scope="col">Difference in cost</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                    @foreach ($gifts as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->estimated_cost }}</td>
                        <td>{{ $item->real_cost }}</td>
                        <td>{{ $item->status}}</td>
                        <td>{{ $item->resname}}</td>
                        <td>{{$item->costDiff}}</td>
                        <td><a href="{{route('gifts.view-gift', $item->id)}}" class="btn btn-info">Ver | Editar</a>
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
