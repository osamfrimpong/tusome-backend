@extends('layouts.admin')

@section('main-content')
    <div class="card">
        <div class="card-header">
            Edit Question
        </div>
        <div class="card-body">
            <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($question->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control" value="{{ $question->subject }}" required>
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" name="year" id="year" class="form-control" value="{{ $question->year }}" required>
                </div>
                <div class="form-group">
                    <label for="question_content">Question Content</label>
                    <textarea name="question_content" id="question_content" class="form-control" required>{{ json_encode($question->question_content) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="is_active">Active</label>
                    <select name="is_active" id="is_active" class="form-control" required>
                        <option value="1" @if($question->is_active) selected @endif>Yes</option>
                        <option value="0" @if(!$question->is_active) selected @endif>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="datetime-local" name="published_at" id="published_at" class="form-control" value="{{ $question->published_at ? $question->published_at->format('Y-m-d\TH:i') : '' }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
