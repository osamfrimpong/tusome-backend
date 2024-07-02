@extends('layouts.admin')

@section('main-content')
    <div class="card">
        <div class="card-header">
            Question Details
        </div>
        <div class="card-body">
            <h5>ID: {{ $question->id }}</h5>
            <p><strong>Category:</strong> {{ $question->category->name }}</p>
            <p><strong>Subject:</strong> {{ $question->subject }}</p>
            <p><strong>Year:</strong> {{ $question->year }}</p>
            <p><strong>Content:</strong> {{ $question->question_content }}</p>
            <p><strong>Active:</strong> {{ $question->is_active ? 'Yes' : 'No' }}</p>
            <p><strong>Published At:</strong> {{ $question->published_at ? $question->published_at->format('d-m-Y H:i:s') : 'N/A' }}</p>
            <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this question?')">Delete</button>
            </form>
        </div>
    </div>
@endsection
