@extends('layouts.master')

@section('content')
<div class="container">
    <div class="d-flex align-item-center justify-content-between">
        <h2 class="mb-4">categories List</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-4">Add New category</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Teacher</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->cost }}</td>
                <td>{{ $category->teacher->name ?? 'Unkown' }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure ?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
