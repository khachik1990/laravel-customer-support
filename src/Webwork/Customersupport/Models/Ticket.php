<?php

namespace Webwork\Customersupport\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Config;

class Ticket extends Eloquent {

    const STATUS_PENDING = 'pending';
    const STATUS_WAITING_REPLY = 'waiting_reply';
    const STATUS_SOLVED = 'solved';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'support_ticket';

    /**
     * The attributes that can be set with Mass Assignment.
     *
     * @var array
     */
    protected $fillable = ['subject', 'message', 'user_id', 'status', 'attached', 'last_activity'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'last_activity'];

    /**
     * Returns all of the static status types of the ticket.
     *
     * @return mixed
     */
    public static function getStatusTypes() {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_WAITING_REPLY => 'Awaiting your reply',
            self::STATUS_SOLVED => 'Solved',
        ];
    }

    /**
     * Comments relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments() {
        return $this->hasMany(Config::get('customersupport.ticket_comment_model'), 'support_ticket_id', 'id');
    }

    /**
     * Thread relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator() {
        return $this->belongsTo(Config::get('customersupport.user_model'), 'user_id', 'id');
    }

    /**
     * Returns tickets with creator.
     *
     * @param $query
     * @param $userId
     * @return mixed
     */
    public function scopeForUser($query, $userId, $ticketStatus) {
        return Ticket::with('creator')->where('status', $ticketStatus);
    }

    /**
     * Change status for a support_ticket table.
     *
     * @param string $status
     */
    public function changeStatus($status) {
        try {
            $ticket = $this->findOrFail($this->id);
            $ticket->status = $status;
            $ticket->save();
        } catch (ModelNotFoundException $e) {
            // do nothing
        }
    }

}
