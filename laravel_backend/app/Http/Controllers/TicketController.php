<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\TicketResource;
use App\Http\Requests\TicketCreateRequest;

class TicketController extends Controller
{
    public function store(TicketCreateRequest $request)
    {
        $data = $request->validated();

        $ticket = Ticket::create([
            ...$data,
            'creator_id' => request()->user()->id,
        ]);

        return new TicketResource($ticket);
    }

    public function show(string $ticket)
    {
        $ticket = Ticket::with('creator', 'members')->findOrFail($ticket);
        return new TicketResource($ticket);
    }

    public function update(Ticket $ticket, TicketCreateRequest $request)
    {
        $ticket->update($request->validated());
        return new TicketResource($ticket);
    }

    public function destroy(Ticket $ticket, Request $request)
    {
        $ticket->delete();
        return response()->json([
            'message' => 'Ticket deleted successfully'
        ]);
    }


    public function assign(Ticket $ticket, Request $request)
    {
        $data = $request->validate([
            'users' => ['required', 'array'],
        ]);



        $users = User::whereIn('email', $data['users'])->select('id', 'email')->get();

        // send email to those users who are not signed up

        $ticket->members()->sync($users->pluck('id'));

        return new TicketResource($ticket);
    }


    public function move(Ticket $ticket, Request $request)
    {
        $data = $request->validate([
            'board_id' => ['nullable', 'exists:boards,id'],
            'rank' => ['required', 'integer'],
        ]);

        $ticket = (new TicketService)->move($data, $ticket);
      
        return new TicketResource($ticket);
    }
}
