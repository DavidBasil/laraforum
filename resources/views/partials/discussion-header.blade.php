<div class="card-header bg-dark text-white">

  <div class="row">
    <div class="col-md-12">
      <img src="{{ Gravatar::src($discussion->author->email) }}" 
           class="rounded-circle" style="height:40px">
           <strong class="ml-2">{{ $discussion->author->name }}</strong>
           <span class="float-right">{{ date('M d Y', strtotime($discussion->created_at)) }}</span>
    </div>
      {{-- <a href="{{ route('discussions.show', $discussion->slug) }}" class="btn btn-success btn-sm">View</a> --}}

  {{-- <div class="col-md-6"> --}}
  {{--   sdfdf --}}
  {{-- </div> --}}

  </div>
</div>
