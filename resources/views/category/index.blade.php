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
                    <th>Created By</th>
                    <th>Created Date</th>
                    <th class="text-end">Action</th>
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
                      <td>{{ __($item->user->name) }}</td>
                      <td style="width:15%">{{ $item->created_at }}</td>
                      <td class="text-end" style="width:10%">
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