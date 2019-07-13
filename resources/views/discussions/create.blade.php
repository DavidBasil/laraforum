@extends('layouts.app')

@section('content')

  <div class="card">
    <div class="card-header">Add Discussion</div>
    <div class="card-body">
      <form ic-post-to="{{ route('discussions.store') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
          <label for="content">Content</label>
            <input id="content" type="hidden" name="content">
            <trix-editor input="content"></trix-editor>
        </div>
        <div class="form-group">
          <label for="channel">Channel</label>
          <select name="channel" id="channel" class="form-control">
          @foreach ($channels as $channel)
            <option value="{{ $channel->id }}">{{ $channel->name }}</option> 
          @endforeach 
          </select>
        </div>
        <button class="btn btn-success w-100" type="submit">Create Discussion</button>
      </form>
    </div>
  </div>

@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.css" type="text/css">
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/intercooler-js/1.2.2/intercooler.min.js" charset="utf-8"></script>
@endpush
