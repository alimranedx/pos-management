@extends('layouts.app')
@section('content')
    <div class="container ">
        @include('flash-message')
        <div class="row my-4">
            <div class="col col-md-8">
                <h4 class="text-center text-success text-uppercase fw-bold">{{ __('Add Category') }}</h4>
            </div>
            <div class="col col-md-4">
                <a href="{{route('category')}}" class="btn btn-success">{{ __('All Category') }}</a>
            </div>
        </div>
        <div class="category-form">
            <div class="row">
                <div class="col col-md-6 offset-md-3">
                    <form action="{{ ($addEdit != 'edit') ? route('category.store') : route('category.update') }}" method="post">
                        @csrf
                        <input type="hidden" name='id' value="{{ ($category->id) ?? ''}}">
                        <div class="mb-3">
                          <label for="name" class="form-label">{{ __('Name') }}</label>
                          <input type="text" class="form-control" name="name" id="name" value="{{ ($category->name) ?? '' }}" aria-describedby="emailHelp">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __(($addEdit != 'edit') ? 'Submit': 'Update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection