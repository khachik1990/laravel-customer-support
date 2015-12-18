@extends('app')
@section('content')
    <div class="container">
        @if (Session::has('error_message'))
            <div class="alert alert-danger" role="alert">
                {!! Session::get('error_message') !!}
            </div>
        @endif
        @if($tickets->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Subject</th>
                        <th>Creation date</th>
                        <th>Last action</th>
                        <th>Status</th>
                        <th>Creator</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                     <tr>
                        <td>ID :{!! $ticket->id !!}</td>
                        <td>{!! link_to('tickets/view/' . $ticket->id, $ticket->subject) !!}</td>
                        <td>{!! $ticket->created_at !!}</td>
                        <td>{!! $ticket->last_activity !!}</td>
                        <td>{!! \Webwork\Customersupport\Models\Ticket::getStatusTypes()[$ticket->status] !!}</td>
                        <td>{!! $ticket->creator->name !!}</td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Sorry, no tickets.</p>
        @endif
    </div>
@stop
