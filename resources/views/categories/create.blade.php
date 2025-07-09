@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New category</h2>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="form-group">
            <label>category Name </label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Price</label>
            <input type="number" name="cost" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Teacher</label>
            {{-- <input type="number" name="teacher_id" value="{{ $category->teacher_id }}" class="form-control" required> --}}
            <select name="teacher_id" class="form-control" id="" required>
                @foreach ($users as $user)
                    @if ($user->type === 'teacher')
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Category</label>
            {{-- <input type="number" name="teacher_id" value="{{ $category->teacher_id }}" class="form-control" required> --}}
            <select name="category_id" class="form-control" id="" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-2">Save</button>
    </form>
</div>
@endsection
