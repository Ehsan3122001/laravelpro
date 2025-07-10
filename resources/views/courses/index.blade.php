@extends('layouts.master')

@section('content')
<div class="container">
    <div class="d-flex align-item-center justify-content-between">
        <h2 class="mb-4">Courses List</h2>
        <a href="{{ route('courses.create') }}" class="btn btn-primary mb-4">Add New Course</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Cost</th>
                <th>Teacher</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->name }}</td>
                <td>{{ $course->cost }}</td>
                <td>{{ $course->teacher->name ?? 'Unkown' }}</td>
                <td>{{ $course->category->name ?? 'Unkown' }}</td>
                <td>
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure ?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
