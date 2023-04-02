@extends('layouts.app')
@section('content')
    <div class="container ">
        @include('flash-message')
        <div class="row my-4">
            <div class="col col-md-8">
                <h4 class="text-center text-success text-uppercase fw-bold">{{ __('Add Brand') }}</h4>
            </div>
            <div class="col col-md-4">
                <a href="{{route('brand')}}" class="btn btn-success">{{ __('All Brand') }}</a>
            </div>
        </div>
        <div class="category-form">
            <div class="row">
                <div class="col col-md-6 offset-md-3">
                    <form action="{{ ($addEdit != 'edit') ? route('brand.store') : route('brand.update') }}" method="post">
                        @csrf
                        <input type="hidden" name='id' value="{{ ($brand->id) ?? ''}}">
                        <div class="mb-3">
                          <label for="category" class="form-label">{{ __('Category') }}</label>
                          <select class="form-select" id="category" name="category_id[]" data-placeholder="Select Category" multiple>
                            @foreach ($categories as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="mb-3">
                          <label for="name" class="form-label">{{ __('Name') }}</label>
                          <input type="text" class="form-control" name="name" id="name" value="{{ ($brand->name) ?? '' }}" aria-describedby="emailHelp">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __(($addEdit != 'edit') ? 'Submit': 'Update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $( '#category' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
    </script>
@endsection