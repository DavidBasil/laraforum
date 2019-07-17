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
       {{-- @if ($discussion->bestReply) --}}
       {{--   <div class="card bg-success text-white"> --}}
       {{--     <div class="card-header p-1"> --}}
       {{--       <div class="d-flex justify-content-between"> --}}
       {{--         <div> --}}
       {{--           <img src="{{ Gravatar::src($discussion->bestReply->owner->email) }}" alt="" class="h-50"> --}}
       {{--           <strong>{{ $discussion->bestReply->owner->name }}</strong> --}}
       {{--         </div> --}}
       {{--         <div> --}}
       {{--           Best Reply --}}
       {{--         </div> --}}
       {{--       </div> --}}
       {{--     </div> --}}
       {{--     <div class="card-body"> --}}
       {{--       {!! $discussion->bestReply->content !!} --}}
       {{--     </div> --}}
       {{--   </div> --}}
       {{-- @endif --}}
    </div>
  </div>  

  <!-- replies -->
  <h5>Replies...</h5>
  <ul class="list-group">
       {{-- @if ($discussion->bestReply) --}}
       {{--   <div class="card bg-success text-white"> --}}
       {{--     <div class="card-header p-1"> --}}
       {{--       <div class="d-flex justify-content-between"> --}}
       {{--         <div> --}}
       {{--           <img src="{{ Gravatar::src($discussion->bestReply->owner->email) }}" alt="" class="h-50"> --}}
       {{--           <strong>{{ $discussion->bestReply->owner->name }}</strong> --}}
       {{--         </div> --}}
       {{--         <div> --}}
       {{--           Best Reply --}}
       {{--         </div> --}}
       {{--       </div> --}}
       {{--     </div> --}}
       {{--     <div class="card-body"> --}}
       {{--       {!! $discussion->bestReply->content !!} --}}
       {{--     </div> --}}
       {{--   </div> --}}
       {{-- @endif --}}
  @foreach ($discussion->replies()->paginate(3) as $reply)
    @if ($reply == $discussion->bestReply)
  <li class="list-group-item">
     <img src="{{ Gravatar::src($reply->owner->email) }}" alt="" class="mb-2" style="height:40px">
       <button class="btn btn-sm btn-danger float-right" disabled data-toggle="tooltip" data-placement="top" title="Best Reply"><span class="h6">&hearts;</span></button>
  <div class="mt-2">
  {{ $reply->content }}
  </div>
  </li> 
    @else
  <li class="list-group-item">
     <img src="{{ Gravatar::src($reply->owner->email) }}" alt="" class="mb-2" style="height:40px">
  @auth
   @if (auth()->user()->id == $discussion->user_id)
     <form 
       action="{{ route('discussions.best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id]) }}" 
       method="post" class="float-right">
       @csrf
       <button type="submit" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Mark as best"><span class="h6">&hearts;</span></button>
     </form>
   @endif
  @endauth
  <div class="mt-2">
  {{ $reply->content }}
  </div>
  </li> 
    @endif
  @endforeach
  </ul>
  {{-- @foreach ($discussion->replies()->paginate(3) as $reply) --}}
  {{--  <div class="card my-3"> --}}
  {{--    <div class="card-header"> --}}
  {{--      <div class="d-flex justify-content-between"> --}}
  {{--        <div> --}}
  {{--          <img src="{{ Gravatar::src($reply->owner->email) }}" alt="" class="h-50"> --}}
  {{--          <span class="ml-2">{{ $reply->owner->name }}</span> --}}
  {{--        </div> --}}
  {{--        <div> --}}
  {{--          @auth --}}
  {{--            @if (auth()->user()->id == $discussion->user_id) --}}
  {{--              <form action="{{ route('discussions.best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id]) }}" method="post"> --}}
  {{--                @csrf --}}
  {{--                <button type="submit" class="btn btn-sm btn-danger">mark as best</button> --}}
  {{--              </form> --}}
  {{--            @endif --}}
  {{--          @endauth --}}
  {{--        </div> --}}
  {{--      </div> --}}
  {{--    </div> --}}
  {{--    <div class="card-body"> --}}
  {{--      {!! $reply->content !!} --}}
  {{--    </div> --}}
  {{--  </div> --}} 
  {{-- @endforeach --}}
  {{ $discussion->replies()->paginate(3) }}

  <div class="card border-light w-75 mx-auto">
    <div class="card-header bg-light">
      Add a reply <span class="h4">&#8595;</span>
    </div>
    <div class="card-body">
      @auth
        <form action="{{ route('replies.store', $discussion->slug) }}" method="post" class="text-center">
          @csrf
          <textarea name="content" rows="4" cols="40" class="form-control"></textarea>
          <button type="submit" class="btn btn-outline-success mt-2 w-100">Add reply</button>
        </form>
      @else
        <a href="" class="btn btn-info text-white">Sign in to add a reply</a>
      @endauth
    </div>
  </div>


@endsection

@push('css')
@endpush

@push('js')
  <script charset="utf-8">
  $(function(){
    $('[data-toggle="tooltip"]').tooltip();
  })
  </script>
@endpush
