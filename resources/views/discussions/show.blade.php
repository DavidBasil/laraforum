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
       @if ($discussion->bestReply)
         <div class="card bg-success text-white">
           <div class="card-header p-1">
             <div class="d-flex justify-content-between">
               <div>
                 <img src="{{ Gravatar::src($discussion->bestReply->owner->email) }}" alt="" class="h-50">
                 <strong>{{ $discussion->bestReply->owner->name }}</strong>
               </div>
               <div>
                 Best Reply
               </div>
             </div>
           </div>
           <div class="card-body">
             {!! $discussion->bestReply->content !!}
           </div>
         </div>
       @endif
    </div>
  </div>  

  <!-- replies -->
  @foreach ($discussion->replies()->paginate(3) as $reply)
   <div class="card my-4">
     <div class="card-header">
       <div class="d-flex justify-content-between">
         <div>
           <img src="{{ Gravatar::src($reply->owner->email) }}" alt="" class="h-50">
           <span class="ml-2">{{ $reply->owner->name }}</span>
         </div>
         <div>
           @auth
             @if (auth()->user()->id == $discussion->user_id)
               <form action="{{ route('discussions.best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id]) }}" method="post">
                 @csrf
                 <button type="submit" class="btn btn-sm btn-danger">mark as best</button>
               </form>
             @endif
           @endauth
         </div>
       </div>
     </div>
     <div class="card-body">
       {!! $reply->content !!}
     </div>
   </div> 
  @endforeach
  {{ $discussion->replies()->paginate(3) }}

  <div class="card">
    <div class="card-header">
      Add a reply
    </div>
    <div class="card-body">
      @auth
        <form action="{{ route('replies.store', $discussion->slug) }}" method="post" class="text-center">
          @csrf
          <input type="hidden" name="content" id="content">
          <trix-editor input="content"></trix-editor>
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
