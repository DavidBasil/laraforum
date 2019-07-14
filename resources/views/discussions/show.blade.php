@extends('layouts.app')

@section('content')

  <div class="card mb-5">
    @include('partials.discussion-header')
    <div class="card-body">
      <div class="text-center font-weight-bold">
        <h3>{{ $discussion->title }}</h3>
      </div>
      <hr>
      {!! $discussion->content !!}
    </div>
  </div>  

  <div class="card">
    <div class="card-header">
      Add a reply
    </div>
    <div class="card-body">
      @auth
        <form action="{{ route('replies.store', $discussion->slug) }}" method="post" class="text-center">
          @csrf
          <input type="hidden" name="reply" id="reply">
          <trix-editor></trix-editor>
          <button type="submit" class="btn btn-success mt-2 w-75">Add reply</button>
        </form>
      @else
        <a href="" class="btn btn-info text-white">Sign in to add a reply</a>
      @endauth
    </div>
  </div>


@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.css" type="text/css">
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.js"></script>  
@endpush
