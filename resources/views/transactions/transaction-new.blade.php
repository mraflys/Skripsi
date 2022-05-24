@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-3">
            <form method="POST" action="{{ route('transactions.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="text" name="web" value="web" hidden>
                <input id="request_By" type="request_By" class="form-control @error('request_By') is-invalid @enderror"
                    name="request_By" value="{{ Auth::user()->id }}" required autocomplete="request_By" hidden>
                <div class="form-group row">
                    <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                    <div class="col-md-6">
                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                            value="{{ old('city') }}" required autofocus>

                        @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="area" class="col-md-4 col-form-label text-md-right">{{ __('Area') }}</label>

                    <div class="col-md-6">
                        <input id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="area"
                            value="{{ old('area') }}" required>

                        @error('area')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="code_area" class="col-md-4 col-form-label text-md-right">{{ __('Code Area') }}</label>

                    <div class="col-md-6">
                        <input id="code_area" type="text" class="form-control @error('code_area') is-invalid @enderror"
                            name="code_area" value="{{ old('code_area') }}" required>

                        @error('code_area')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nominal" class="col-md-4 col-form-label text-md-right">{{ __('Nominal') }}</label>

                    <div class="col-md-6">
                        <input id="nominal" type="number" class="form-control @error('nominal') is-invalid @enderror"
                            name="nominal" value="{{ old('nominal') }}" required>

                        @error('nominal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nominal" class="col-md-4 col-form-label text-md-right">{{ __('description') }}</label>

                    <div class="col-md-6">

                        <textarea id="description" class="form-control @error('nominal') is-invalid @enderror" name="description"
                            value="{{ old('description') }}" rows="5">

                        </textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Upload File') }}</label>

                    <div class="col-md-6">
                        <input id="file" type="file" accept="image/*"
                            class="form-control @error('file') is-invalid @enderror" name="file" required>

                        @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
    </script>
@endsection
