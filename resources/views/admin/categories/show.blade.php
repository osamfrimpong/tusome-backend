@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Category Details</h1>
    <div class="card mb-3">
        <div class="card-header">
            <h2>{{ $category->name }}</h2>
        </div>
        <div class="card-body">
            <p>{{ $category->description }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
            </form>
        </div>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back to Categories</a>
</div>
@endsection
