@extends('app')

@section('content')
<div class="container">
    <div class="col-md-6">
        <div class="media">
            <h1>{!! $ticket->subject !!}</h1>
            <h2>{!! $ticket->message !!}</h2>
            <h3>{!! $ticket->creator->name !!}<h3>
            @if($ticket->attached)
            <h3>{!! link_to('tickets/download/ticket/' . $ticket->attached, 'Download'.$ticket->attached) !!}</h3>
            @endif
            <img src="//www.gravatar.com/avatar/{!! md5($ticket->creator->email) !!}?s=64" alt="{!! $ticket->creator->name !!}" class="img-circle">
        </div>
        <div id="ticket_{{$ticket->id}}">
            @foreach($comments as $comment)
                @include('customersupport.html-comment', ['comment' => $comment])
            @endforeach
        </div>
        <h1>Add a new comment</h1>
        {!! Form::open(['route' => ['tickets.addComment', $ticket->id], 'method' => 'POST', 'files'=>true]) !!}
            <!-- Message Form Input -->
            <div class="form-group">
                {!! Form::label('comment', 'Comment', ['class' => 'control-label']) !!}
                {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Attached Form Input -->
            <div class="form-group">
                {!! Form::label('attached', 'Attached', ['class' => 'control-label']) !!}
                {!! Form::file('attached', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Submit Form Input -->
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                    @if($ticket->status != \Webwork\Customersupport\Models\Ticket::STATUS_SOLVED)
                    {!! link_to('tickets/solved/' . $ticket->id, 'Make as solved',['class' => 'btn btn-primary']) !!}
                @endif
            </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
