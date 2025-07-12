<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\PageMessage;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        // Ensure the authenticated user is an owner
        if ($request->user()->role !== 'owner') {
            return response()->json(['message' => 'Unauthorized. Only owners can view messages.'], 403);
        }

        // Fetch all messages with sender and receiver details
        $messages = PageMessage::select('page_messages.*')
            ->with(['user' => function ($query) {
                $query->select('id', 'name');
            }, 'receiver' => function ($query) {
                $query->select('id', 'name');
            }])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($message) {
                return [
                    'id' => $message->id,
                    'title' => $message->title,
                    'message' => $message->message,
                    'type' => $message->type,
                    'sender_name' => $message->user->name ?? 'Unknown',
                    'receiver_name' => $message->receiver->name ?? 'Unknown',
                    'created_at' => $message->created_at->toDateTimeString(),
                ];
            });

        return response()->json([
            'messages' => $messages,
        ]);
    }
}
