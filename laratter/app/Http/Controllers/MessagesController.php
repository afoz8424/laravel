<?php

namespace App\Http\Controllers;

use App\Message;
use App\Http\Requests\CreateMessageRequest;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function show(Message $message)
    {
    	/*$message = Message::find($id);*/
    	return view('messages.show',[
    		'message'=>$message,
    	]);
    }
    public function create(CreateMessageRequest $request)
    {
    	$user = $request->user();
        $message = Message::create([
    		'content'=>$request->input('message'),
    		'image' => 'https://picsum.photos/200/300/?'.mt_rand(0,100),
            'user_id' => $user->id
    	]);

    	return redirect('/messages/'.$message->id);
    }
}
