@extends('layouts.app')
@section('content')
    <div class="container ">
        @include('flash-message')
        <div class="row my-4">
            <div class="col col-md-8">
                <h4 class="text-center text-success text-uppercase fw-bold">{{ __('Add Brand') }}</h4>
            </div>
            <div class="col col-md-4">
                <a href="{{route('brands')}}" class="btn btn-success">{{ __('All Brand') }}</a>
            </div>
        </div>
        <div class="category-form">
            <div class="row">
                <div class="col col-md-6 offset-md-3">
                    <form action="{{ ($addEdit != 'edit') ? route('brand.store') : route('brand.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name='id' value="{{ ($brand->id) ?? ''}}">
                        <div class="mb-3">
                            <label for="category" class="form-label">{{ __('Category') }}</label>
                            <select class="form-control" id="category" name="category[]" multiple="multiple">
                            @foreach ($categories as $data)
                                <option value="{{$data->id}}">{{ $data->name }}</option>
                            @endforeach
                          </select>
                          </div>
                        <div class="mb-3">
                          <label for="name" class="form-label">{{ __('Name') }}</label>
                          <input type="text" class="form-control" name="name" id="name" value="{{ ($brand->name) ?? '' }}" >
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Brand Icon') }}</label>
                            <input type="file" class="form-control" name="image" id="image" value="{{ ($brand->image) ?? '' }}" accept="image/*" >
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __(($addEdit != 'edit') ? 'Submit': 'Update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#category').select2();
        });
    </script>
@endsection
