@extends('layouts.app')

@section('content')

  <div class="card">
    <div class="card-header bg-dark text-white font-weight-bold">Add Discussion</div>
    <div class="card-body">
      <form action="{{ route('discussions.store') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="title"><h5>Title</h5></label>
          @error('title')
          <p class="text-danger">{{ $message }}</p>
          @enderror
          <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
          <label for="content"><h5>Content</h5></label>
          @error('content')
          <p class="text-danger">{{ $message }}</p>
          @enderror
          <textarea name="content" rows="6" cols="40" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="channel"><h5>Channel</h5></label>
          <select name="channel" id="channel" class="form-control">
          @foreach ($channels as $channel)
            <option value="{{ $channel->id }}">{{ $channel->name }}</option> 
          @endforeach 
          </select>
        </div>
        <button class="btn btn-outline-primary w-100" type="submit">Create Discussion</button>
      </form>
    </div>
  </div>

@endsection

@push('css')
@endpush

@push('js')
@endpush
