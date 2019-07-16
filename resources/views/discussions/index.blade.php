@extends('layouts.app')

@section('content')

  @foreach ($discussions as $discussion)
    <div class="card mb-3">
      @include('partials.discussion-header')
      <div class="card-body">
        <div class="text-center font-weight-bold">
        <h4>{{ $discussion->title }}</h4>
        </div>
      </div>
    </div>  
  @endforeach

  {{ $discussions->appends(['channel' => request()->query('channel')])->links() }}

@endsection
