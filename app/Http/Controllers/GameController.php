<?php

namespace App\Http\Controllers;

use App\Events\UpdateGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class GameController extends Controller
{
    public function index()
    {
        return view('game');
    }

    public function makeMove(Request $request)
    {
        // Lakukan validasi data yang diterima
        $request->validate([
            'position' => 'required|integer|between:0,8',
            'player' => 'required|in:X,O',
        ]);

        $position = $request->input('position');
        $player = $request->input('player');

        // Simpan data langkah di Redis
        Redis::set('tic-tac-toe:position', $position);
        Redis::set('tic-tac-toe:player', $player);

        // Broadcast event untuk mengupdate permainan pada semua klien
        broadcast(new UpdateGame(['position' => $position, 'player' => $player]))->toOthers();

        return response()->json(['message' => 'Move successful.']);
    }

}
