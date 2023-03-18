@extends('layouts.app')
@section('content')
    <div class="container category my-4 ">
        <div class="row">
            <div class="col col-md-8">
                <h4 class="text-center text-success text-uppercase fw-bold">{{ __('Category List') }}</h4>
            </div>
            <div class="col col-md-4">
                <a href="{{ route('category.add') }}" class="btn btn-success float-end">{{ __('Add Category') }}</a>
            </div>
        </div>
        <div class="table">
          @include('flash-message')
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                      $sl = 0;
                  @endphp
                  @foreach ($data as $item)
                  @php
                      $sl++;
                  @endphp
                    <tr>
                      <td>{{ $sl }}</td>
                      <td>{{ __($item->name) }}</td>
                      <td>
                        <a href="{{route('category.edit', $item->id)}}" class="btn btn-sm btn-success">{{ __('edit') }}</a>
                        <a href="{{ route('category.delete', $item->id) }}" class="btn btn-sm btn-danger">{{ __('delete') }}</a>
                      </td>
                    </tr>
                  @endforeach
                  
                </tbody>
              </table>
        </div>
    </div>
@endsection