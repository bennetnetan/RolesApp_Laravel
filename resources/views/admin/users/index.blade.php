@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                      <table class="table table-dark">
                          <thead>
                              <tr>
                                 <th>#</th> 
                                 <th>Name</th>
                                 <th>Email</th>
                                 <th>Roles</th>
                                 <th>Actions</th>
                              </tr>
                          </thead>
                            @foreach ($users as $user)
                                <tbody>
                                    <tr>
                                        <th scope="row">{{$user->id}}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                        <td>
                                            <div class="row">
                                                @can('edit-users')
                                                    <a href="{{route('admin.users.edit', $user->id)}}" type="button" class="btn btn-primary float-left">Edit</a>
                                                @endcan
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    @can('delete-users')
                                                        <button class="btn btn-warning float-left" type="submit">Delete</button>    
                                                    @endcan

                                                </form>
                                            </div>
                                        {{-- <a href="{{route('admin.users.destroy', $user->id)}}" type="button" class="btn btn-warning">Delete</a> --}}
                                        </td>
                                        
                                    </tr>
                                </tbody>
                            @endforeach
                      </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
