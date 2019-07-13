@extends('layouts.app')

@section('content')

  @foreach ($discussions as $discussion)
    <div class="card mb-3">
      <div class="card-header">
      </div>
      <div class="card-body">
        {!! $discussion->content !!}
      </div>
    </div>  
  @endforeach

  {{ $discussions->links() }}

@endsection
