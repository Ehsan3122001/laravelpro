@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit category</h2>

    <form method="POST" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>category Name</label>
            <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Price</label>
            <input type="number" name="cost" value="{{ $category->cost }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Teacher ID</label>
            {{-- <input type="number" name="teacher_id" value="{{ $category->teacher_id }}" class="form-control" required> --}}
            <select name="teacher_id" class="form-control" id="" required>
                @foreach ($users as $user)
                    @if ($user->type === 'teacher')
                        <option value="{{ $user->id }}" {{ $category->teacher_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>
@endsection
