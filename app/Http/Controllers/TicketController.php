<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Jobs\ClassifyTicket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
        public function index(Request $request)
        {
            $query = Ticket::query();
            
            // Search functionality
            if ($request->has('search') && !empty($request->search)) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('subject', 'like', '%'.$searchTerm.'%')
                    ->orWhere('body', 'like', '%'.$searchTerm.'%');
                });
            }
            
            // Category filter
            if ($request->has('category') && !empty($request->category)) {
                $query->where('category', $request->category);
            }
            
            // Status filter
            if ($request->has('status') && !empty($request->status)) {
                $query->where('status', $request->status);
            }

            return $query->orderBy('created_at', 'desc')->get();
        }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        
        $ticket = Ticket::create($validated);
        
        return response()->json($ticket, 201);
    }

    public function classify(Ticket $ticket)
    {
        ClassifyTicket::dispatch($ticket);
        
        return response()->json(['message' => 'Classification job queued']);
    }
}