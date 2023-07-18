<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $menu = 'Chat';
        $users = \DB::table('users')->get();
        $chat_from_me = \DB::table('chats')
                            ->orderByDesc('id_chat')
                            ->where('nip_user', Auth::user()->nip)
                            ->join('users','users.nip','=','chats.linked_user')
                            ->select('chats.*','users.name','users.picture')
                            ->get();
        $chat_from_other = \DB::table('chats')
                                ->orderByDesc('id_chat')
                                ->where('linked_user', Auth::user()->nip)
                                ->join('users','users.nip','=','chats.nip_user')
                                ->select('chats.*','users.name','users.picture')
                                ->get();
                                
        return view('pages.app.user.chat.index', compact('menu','users','chat_from_me','chat_from_other'));
    }

    public function create_topic(Request $req, $name, $session_chat)
    {
        $menu = 'Chat';
        $user = \DB::table('users')
                    ->where('name', $name)->first();

        return view('pages.app.user.chat.create_topic', compact('menu','user','session_chat'));            
    }

    public function store_topic(Request $req)
    {
        $this->validate($req, [
            'topic_chat' => 'required'
        ]);

        $store = \DB::table('chats')
                    ->insert([
                        'session_chat' => $req->session_chat,
                        'nip_user' => Auth::user()->nip,
                        'topic_chat' => $req->topic_chat,
                        'linked_user' => $req->linked_user,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    
        return redirect('/user/chat');
    }

    public function create_chat($session_chat)
    {
        $menu = 'Chat';
        $status_chat = 'From Me';
        $user = \DB::table('chats')
                    ->where('session_chat', $session_chat)
                    ->join('users','users.nip','=','chats.linked_user')
                    ->select('users.name','users.picture','chats.*')
                    ->first();
        $messages = \DB::table('messages')
                        ->orderBy('created_at','asc')
                        ->where('session_chat', $session_chat)
                        ->join('users','users.nip','=','messages.nip_user')
                        ->select('users.name','users.picture','messages.*')
                        ->get();
        
        return view('pages.app.user.chat.chat_session', compact('menu','user','messages','status_chat'));
    }

    public function create_linked_chat($session_chat)
    {
        $menu = 'Chat';
        $status_chat = 'From You';
        $user = \DB::table('chats')
                    ->where('session_chat', $session_chat)
                    ->join('users','users.nip','=','chats.nip_user')
                    ->select('users.name','users.picture','chats.*')
                    ->first();
        $messages = \DB::table('messages')
                        ->orderBy('created_at','asc')
                        ->where('session_chat', $session_chat)
                        ->join('users','users.nip','=','messages.nip_user')
                        ->select('users.name','users.picture','messages.*')
                        ->get();
        
        return view('pages.app.user.chat.chat_session', compact('menu','user','messages','status_chat'));
    }

    public function store_chat(Request $req)
    {
        $this->validate($req, [
            'message' => 'required'
        ]);

        $store_message = \DB::table('messages')
                            ->insert([
                                'nip_user' => Auth::user()->nip,
                                'session_chat' => $req->session_chat,
                                'message' => $req->message,
                                'updated_at' => now(),
                                'created_at' => now()
                            ]);

        return redirect()->back();
    }
}
