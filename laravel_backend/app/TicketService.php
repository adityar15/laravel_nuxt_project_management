<?php

namespace App;

use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class TicketService
{
    /**
     * Create a new class instance.
     */
    public function move(array $data, Ticket $ticket)
    {
        $currentBoardId = $ticket->board_id;
        $newBoardId = $data['board_id'] ?? null;
        $newRank = $data['rank'];
      
        try {
            DB::beginTransaction();

            $isSameBoard = ($currentBoardId == $newBoardId) || !$newBoardId;


            if ($isSameBoard && $ticket->rank < $newRank) {
               
                Ticket::where('board_id', $ticket->board_id)
                    ->whereBetween('rank', [$ticket->rank + 1, $newRank])
                    ->decrement('rank');

            } else if ($isSameBoard && $ticket->rank > $newRank) {
               
                Ticket::where('board_id', $ticket->board_id)
                    ->whereBetween('rank', [$newRank, $ticket->rank - 1])
                    ->increment('rank');

            } else if(!$isSameBoard) {
                // Adjust ranks in the old board
                Ticket::where('board_id', $currentBoardId)
                    ->where('rank', '>', $ticket->rank)
                    ->decrement('rank');

                // Adjust ranks in the new board
                Ticket::where('board_id', $newBoardId)
                    ->where('rank', '>=', $newRank)
                    ->increment('rank');

               

            }
           
            $ticket->board_id = $newBoardId ?? $currentBoardId;
            $ticket->rank = $newRank;
            $ticket->save();

            DB::commit();
            return $ticket;
        } catch (\Exception $e) {
            info($e->getMessage());
            DB::rollBack();
            throw $e;
        }
    }
}
