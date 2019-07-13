@extends('layouts.app')

@section('content')

    <div class="card mb-3">
      @include('partials.discussion-header')
      <div class="card-body">
        <div class="text-center font-weight-bold">
        <h3>{{ $discussion->title }}</h3>
        </div>
        <hr>
        {!! $discussion->content !!}
      </div>
    </div>  


@endsection
