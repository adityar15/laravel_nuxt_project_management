<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use App\Http\Resources\BoardResource;
use App\Http\Requests\BoardCreateRequest;

class BoardController extends Controller
{
    public function store(BoardCreateRequest $request)
    {
        $data = $request->validated();

        $board = Board::create($data);

        return new BoardResource($board);
    }

    public function update(Board $board, BoardCreateRequest $request)
    {
        $board->update($request->validated());
        return new BoardResource($board);
    }

    public function destroy(Board $board, Request $request)
    {
        $board->load("project");

        abort_if($board->project->user_id !== $request->user()->id, 403, "You are not allowed to delete this board");

        $board->delete();

        return response()->json([
            'message' => 'Board deleted successfully'
        ]);

    }
}
