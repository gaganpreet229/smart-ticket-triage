<?php

namespace App\Jobs;

use App\Models\Ticket;
use App\Services\TicketClassifier;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ClassifyTicket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Ticket $ticket) {}

    public function handle(TicketClassifier $classifier)
    {
        $classification = $classifier->classify(
            $this->ticket->subject,
            $this->ticket->body
        );
        
        $this->ticket->update([
            'category' => $classification['category'],
            'confidence' => $classification['confidence']
        ]);
    }
}