@extends('layouts.main-template')
@section('title', isset($title) ? $title : 'Dashboard | Admin')
@section('content')

<div class="row">
    <div class="col-md-12 mt-3">
        <h4>Active Companies</h4>
    </div>
    @php
    $users = App\Models\User::all();
    @endphp
    <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created On</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>                  
                        <td>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>

@endsection