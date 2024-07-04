@extends('layouts.admin')

@section('main-content')
<div class="card">
    <div class="card-header">
        Create Question
    </div>
    @if ($errors->any())
        <div class="alert alert-danger mb-3 mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card-body">
        <form action="{{ route('admin.questions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', request()->input('category_id')) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="sub_category_id">Sub Category</label>
                <select name="sub_category_id" id="sub_category_id" class="form-control" required>
                    <option value="">Select Sub Category</option>
                  
                        @foreach($subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}" {{ old('sub_category_id', request()->input('sub_category_id')) == $subCategory->id ? 'selected' : '' }}>
                                {{ $subCategory->name }}
                            </option>
                        @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="year">Year</label>
                <select name="year" id="year" class="form-control" required>
                    @php
                        $currentYear = date('Y');
                    @endphp
                    @for ($year = $currentYear; $year >= 2000; $year--)
                        <option value="{{ $year }}" {{ (old('year') ?? request()->get('year')) == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="question_content">Question Content</label>
                <textarea name="question_content" id="question_content" class="form-control" required
                          placeholder='[{question_number: 1, question_details: " What is xyz", answer_options: {a:
                xyz, b: xyz, c: xyz, d: xyz, e: xyz}, correct_option: c, year: xxxx, subject: subjectNameOrId,
                category_id: idFromDatabase}]'></textarea>
            </div>
            <div class="form-group">
                <label for="is_active">Active</label>
                <select name="is_active" id="is_active" class="form-control" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="published_at">Published At</label>
                <input type="datetime-local" name="published_at" id="published_at" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/category.js') }}"></script>
@endsection
