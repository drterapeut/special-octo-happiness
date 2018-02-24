<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\User;

class ChatMessageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $messages = ChatMessage::with('user')->get();

        return response()->json($messages);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|string',
        ]);

        $id = Auth::id();
        $chat_message = new ChatMessage;
        $chat_message->message = $request->message;
        $chat_message->user_id = $id;
        $chat_message->save();

        return response()->json($chat_message);
    }
}
