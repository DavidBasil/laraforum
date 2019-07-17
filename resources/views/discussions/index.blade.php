@extends('layouts.app')

@section('content')

  @foreach ($discussions as $discussion)
    <div class="card mb-3">
      @include('partials.discussion-header')
      <div class="card-body">
        <div class="text-center font-weight-bold">
        <h5>{{ $discussion->title }}</h5>
        </div>
       <a href="{{ route('discussions.show', $discussion->slug) }}" class="stretched-link"></a>
      </div>
    </div>  
    <hr>
  @endforeach

  {{ $discussions->appends(['channel' => request()->query('channel')])->links() }}

@endsection
