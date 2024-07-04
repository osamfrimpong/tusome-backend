@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Edit Category</h1>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="parent_id">Parent Category</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">Select Parent Category</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="is_active">Active</label>
            <select name="is_active" id="is_active" class="form-control" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
@endsection
