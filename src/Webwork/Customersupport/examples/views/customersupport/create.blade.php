@extends('app')

@section('content')
<div class="container">
    <h1>Create a new ticket</h1>
    {!! Form::open(['route' => 'tickets.store', 'files'=>true]) !!}
    <div class="col-md-6">
        <!-- Subject Form Input -->
        <div class="form-group">
            {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
            {!! Form::text('subject', null, ['class' => 'form-control']) !!}
        </div>
		<!-- Subject Form Input -->
        <div class="form-group">
            {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>
		<!-- Attached Form Input -->
		<div class="form-group">
		{!! Form::label('attached', 'Attached', ['class' => 'control-label']) !!}
		{!! Form::file('attached', null, ['class' => 'form-control']) !!}
		</div>

        <!-- Submit Form Input -->
        <div class="form-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop
