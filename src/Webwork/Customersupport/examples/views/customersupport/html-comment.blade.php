<div class="media">
    <a class="pull-left" href="#">
        <img src="//www.gravatar.com/avatar/{!! md5($comment->creator->email) !!}?s=64" alt="{!! $comment->creator->first_name !!}" class="img-circle">
    </a>
    <div class="media-body">
        <h5 class="media-heading">{!! $comment->creator->name !!} {!! $comment->creator->name !!}</h5>
        <p>{!! $comment->comment !!}</p>
		@if($comment->attached)
				<h5>{!! link_to('tickets/download/comment/' . $comment->attached, 'Download'.$comment->attached) !!}</h5>
		@endif
        <div class="text-muted"><small>Posted {!! $comment->created_at->diffForHumans() !!}</small></div>
    </div>
	
</div>