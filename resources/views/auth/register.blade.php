

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-4">
                                <div class="btn-group w-100" role="group" aria-label="User role select group">
                                    <input type="radio" class="btn-check" name="role-radio" id="patient-radio" autocomplete="off" checked>
                                    <label class="btn btn-outline-primary" for="patient-radio">I am a patient</label>

                                    <input type="radio" class="btn-check" name="role-radio" id="doctor-radio" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="doctor-radio">I am a doctor</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 invisible" id="category-row">
                            <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select name="category_id" id="category" class="form-select">
                                    @foreach($categories as $id => $title)
                                        <option value="{{$id}}" {{$id == $patientCategoryId ? 'selected' : ''}}>{{$title}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-content')
    <script>
        function getSelectOption(selectEl, optionValue) {
            for (let i = 0; i<selectEl.length; i++) {
                if (selectEl.options[i].value === optionValue) {
                    return selectEl.options[i];
                }
            }
        }

        function removeSelectOption(selectEl, optionValue) {
            let option = null;
            for(let i = 0; i<selectEl.length; i++) {
                if (selectEl.options[i].value === optionValue) {
                    selectEl.remove(i);
                }
            }

            return option;
        }

        function selectOptionExists(selectEl, optionValue) {
            for(let i = 0; i<selectEl.length; i++) {
                if (selectEl.options[i].value === optionValue) {
                    return true;
                }
            }

            return false;
        }

        function addSelectOption(selectEl, option) {
            if (!selectOptionExists(selectEl, option.value)) {
                selectEl.add(option);
                return true;
            }
            return false;
        }

        window.onload = function() {
            let categoryRow = document.getElementById('category-row');
            let patientRadio = document.getElementById('patient-radio');
            let doctorRadio = document.getElementById('doctor-radio');
            let categorySelect = document.getElementById('category');

            let patientCategoryId = '{{$patientCategoryId}}';

            let patientCategoryOption = getSelectOption(categorySelect, patientCategoryId);

            console.log('patientCategoryOption', patientCategoryOption);
            console.log('patientCategoryOption.value', patientCategoryOption.value);
            console.log('patientCategoryOption.text', patientCategoryOption.text);

            categorySelect.value = patientCategoryId;

            patientRadio.addEventListener('click', function(e) {
                if (!categoryRow.classList.contains('invisible')) {
                    categoryRow.classList.add('invisible');
                }

                addSelectOption(categorySelect, patientCategoryOption);

                categorySelect.value = patientCategoryId;
            });

            doctorRadio.addEventListener('click', function(e) {
                removeSelectOption(categorySelect, patientCategoryId);
                if (categoryRow.classList.contains('invisible')) {
                    categoryRow.classList.remove('invisible');
                }

                categorySelect.value = null;

                // removeSelectOption(categorySelect, patientCategoryId);
            });

        }
    </script>
@endsection
