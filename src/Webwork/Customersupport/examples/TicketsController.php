<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Webwork\Customersupport\Models\Ticket;
use Webwork\Customersupport\Models\TicketComment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Services\PusherWrapper as Pusher;
use App\User;

class TicketsController extends Controller {

    /**
     * Show all of the tickets to the user.
     *
     * @return mixed
     */
    public function index($status = null) {
        if (!$status) {
            $status = Ticket::STATUS_PENDING;
        }
        $currentUserId = Auth::user()->id;
        $tickets = Ticket::forUser($currentUserId, $status)->get();
        return view('customersupport.index', compact('tickets', 'currentUserId'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id) {
        try {
            $ticket = Ticket::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The ticket with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }

        $comments = $ticket->comments()->get();
        return view('customersupport.show', compact('ticket', 'comments'));
    }

    /**
     * Creates a new ticket.
     *
     * @return mixed
     */
    public function create() {
        return view('customersupport.create');
    }

    /**
     * Stores a new ticket.
     *
     * @return mixed
     */
    public function store() {
        $fileName = '';
        if (Input::file('attached')) {
            $destinationPath = 'uploads/customersupport/attached/ticket'; // upload path
            $extension = Input::file('attached')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999) . time() . '.' . $extension; // renameing image
            Input::file('attached')->move($destinationPath, $fileName); // uploading file to given path
        }

        $input = Input::all();
        $user_id = Auth::user()->id;
        $ticket = Ticket::create(
                        [
                            'subject' => $input['subject'],
                            'message' => $input['message'],
                            'user_id' => $user_id,
                            'status' => Ticket::STATUS_PENDING,
                            'attached' => $fileName,
                            'last_activity' => new Carbon
                        ]
        );

        return redirect('tickets');
    }

    public function addComment($id) {
        try {
            $ticket = Ticket::findOrFail($id);
            $input = Input::all();
            $user_id = Auth::user()->id;

            $fileName = '';
            if (Input::file('attached')) {
                $destinationPath = 'uploads/customersupport/attached/comment'; // upload path
                $extension = Input::file('attached')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111, 99999) . time() . '.' . $extension; // renameing image
                Input::file('attached')->move($destinationPath, $fileName); // uploading file to given path
            }

            $ticketComment = TicketComment::create(
                            [
                                'support_ticket_id' => $id,
                                'user_id' => $user_id,
                                'comment' => $input['comment'],
                                'attached' => $fileName
                            ]
            );

            $ticket->last_activity = new Carbon;
            $ticket->save();
            return redirect('tickets/view/' . $id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The ticket with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }
    }

    public function makeSolved($id) {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->changeStatus(Ticket::STATUS_SOLVED);
            return redirect('tickets/view/' . $id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The ticket with ID: ' . $id . ' was not found.');
            return redirect('tickets');
        }
    }

}
