@extends('layouts.app')

@section('content')

  <div class="card">
    <div class="card-header">Add Discussion</div>
    <div class="card-body">
      <form action="{{ route('discussions.store') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
          <label for="content">Content</label>
          <textarea name="content" rows="8" cols="40" class="form-control"></textarea>
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
