@extends('layouts.admin')

@section('main-content')
    <div class="card">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h4 style="margin: 0;">Questions</h4>
                <a href="{{ route('admin.questions.create') }}" class="btn btn-sm btn-primary">Create Question</a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
                <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Details</th>
                        <th>Subject</th>
                        <th>Year</th>
                        <th>Content</th>
                        <th>Active</th>
                        <th>Published At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $question)
                        <tr>
                            <td>{{ $question->id }}</td>
                            <td>{{ $question->formatted_category_details['main_category_id']['name'] }}
                                > {{ $question->formatted_category_details['country_category_id']['name'] }}
                                > {{ $question->formatted_category_details['type_category_id']['name'] }}</td>
                            <td>{{ $question->category->name }}</td>
                            <td>{{ $question->year }}</td>
                            <td>Click View</td>
                            <td>{{ $question->is_active ? 'Yes' : 'No' }}</td>
                            <td>{{ $question->published_at ? $question->published_at->format('d-m-Y') : 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.questions.show', $question->id) }}" class="btn btn-sm btn-info mb-2 mb-sm-0 mb-md-0 mb-lg-0 mb-xl-0 mb-xxl-0">View</a>
                                <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-sm btn-primary mb-2 mb-sm-0 mb-md-0 mb-lg-0 mb-xl-0 mb-xxl-0">Edit</a>
                                <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this question?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
        </div>
    </div>
@endsection
