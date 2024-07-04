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
                <div class="form-group mb-3">
                    <label for="main_category_id">Main Category</label>
                    <select name="main_category_id" id="main_category_id" class="form-control" required>
                        <option value="">Select Main Category</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ old('category_id', request()->input('category_id')) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="county_category_id">Country</label>
                    <select name="country_category_id" id="country_category_id" class="form-control" required>
                        <option value="">Select Country</option>

                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="type_category_id">Exam/Programme/College Type</label>
                    <select name="type_category_id" id="type_category_id" class="form-control" required>
                        <option value=""> Select Exam/Programme/College Type</option>


                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="subject_category_id">Subject</label>
                    <select name="subject_category_id" id="subject_category_id" class="form-control" required>
                        <option value="">Select Subject</option>

                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="year">Year</label>
                    <select name="year" id="year" class="form-control" required>
                        @php
                            $currentYear = date('Y');
                        @endphp
                        @for ($year = $currentYear; $year >= 2000; $year--)
                            <option
                                value="{{ $year }}" {{ (old('year') ?? request()->get('year')) == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="question_content">Question Content</label>
                    <textarea name="question_content" id="question_content" rows="10" class="form-control" required
                              placeholder='[
  {
    "question_number": 1,
    "question_details": "question details",
    "answer_options": {
      "a": "xyz",
      "b": "xyz",
      "c": "xyz",
      "d": "xyz",
      "e": "xyc"
    },
    "correct_option": "correct option",
    "year": xxx,
  },
 ....

]'></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="is_active">Active</label>
                    <select name="is_active" id="is_active" class="form-control" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group  mb-3">
                    <label for="published_at">Published At</label>
                    <input type="datetime-local" name="published_at" id="published_at" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const selects = [
                '#main_category_id',
                '#country_category_id',
                '#type_category_id',
                '#subject_category_id'
            ];

            selects.forEach((select, index) => {
                if (index < selects.length - 1) {
                    $(select).on('change', function() {
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
                    success: function(data) {
                        $childSelect.html('<option value="">Select option</option>');
                        $.each(data, function(index, item) {
                            $childSelect.append($('<option>', {
                                value: item.id,
                                text: item.name
                            }));
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        $childSelect.html('<option value="">Error loading options</option>');
                    }
                });
            }
        });
    </script>
@endsection
