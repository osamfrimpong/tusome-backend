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
                <div class="form-group mb-3">
                    <label for="main_category_id">Main Category</label>
                    <select name="main_category_id" id="main_category_id" class="form-control" required>
                        <option value="">Select Main Category</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ $question->category_details['main_category_id'] == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="county_category_id">Country</label>
                    <select name="country_category_id" id="country_category_id" class="form-control" required>
                        <option value="{{ $question->formatted_category_details['country_category_id']['id']}}"
                                selected>{{ $question->formatted_category_details['country_category_id']['name']}}</option>

                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="type_category_id">Exam/Programme/College Type</label>
                    <select name="type_category_id" id="type_category_id" class="form-control" required>
                        <option value="{{ $question->formatted_category_details['type_category_id']['id']}}"
                                selected>{{ $question->formatted_category_details['type_category_id']['name']}}</option>


                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="subject_category_id">Subject</label>
                    <select name="subject_category_id" id="subject_category_id" class="form-control" required>
                        <option value="{{ $question->formatted_category_details['subject_category_id']['id']}}"
                                selected>{{ $question->formatted_category_details['subject_category_id']['name']}}</option>

                    </select>
                </div>

                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" name="year" id="year" class="form-control" value="{{ $question->year }}"
                           required>
                </div>
                <div class="form-group">
                    <label for="question_content">Question Content</label>
                    <textarea name="question_content" id="question_content" class="form-control"
                              required>{{ json_encode($question->question_content) }}</textarea>
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
                    <input type="datetime-local" name="published_at" id="published_at" class="form-control"
                           value="{{ $question->published_at ? $question->published_at->format('Y-m-d\TH:i') : '' }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            const selects = [
                '#main_category_id',
                '#country_category_id',
                '#type_category_id',
                '#subject_category_id'
            ];

            selects.forEach((select, index) => {
                if (index < selects.length - 1) {
                    $(select).on('change', function () {
                        updateChildSelect($(this).val(), selects[index + 1]);
                    });
                }
            });

            function updateChildSelect(parentId, childSelectId) {
                const $childSelect = $(childSelectId);
                $childSelect.html('<option value="">Loading...</option>');

                $.ajax({
                    url: `/api/get-subcategories/${parentId}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $childSelect.html('<option value="">Select option</option>');
                        $.each(data, function (index, item) {
                            $childSelect.append($('<option>', {
                                value: item.id,
                                text: item.name
                            }));
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        $childSelect.html('<option value="">Error loading options</option>');
                    }
                });
            }
        });
    </script>
@endsection
