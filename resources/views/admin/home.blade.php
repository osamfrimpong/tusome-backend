@extends('layouts.admin')
@section('main-content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Categories</h5>
                <p class="mb-0">{{$categories->count()}} </p>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Questions</h5>
                <p class="mb-0">{{$questions->count()}}</p>
            </div>
        </div>
    </div>



    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Users</h5>
                <p class="mb-0">{{$users->count()}}</p>
            </div>
        </div>
    </div>



</div>


<div class="row">
    <div class="col-12">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h4 style="margin: 0;">Recently Added Questions</h4>
            <a href="{{ route('admin.questions.index') }}" class="btn btn-sm btn-primary">View All</a>
        </div>
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
                @foreach($questions->take(5) as $question)
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
<div class="row">
    <div class="col-12">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h4 style="margin: 0;">Recent Users</h4>
            <a href="{{ route('admin.questions.index') }}" class="btn btn-sm btn-primary">View All</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered at</th>
{{--                    <th>Actions</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($users->take(5) as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
