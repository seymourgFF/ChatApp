<?php

namespace App\Http\Controllers;

use App\Events\LsMessageSent;
use App\Http\Requests\LsMessageFormRequest;
use App\Http\Requests\MessageFormRequest;
use App\Models\LsMessages;
use App\Models\Message;
use App\Models\User;
use Illuminate\Console\View\Components\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function index()
    {
        if(auth()->user()){
            return view('chat');
        }
        return redirect('/');

    }

    public function users()
    {
        if(auth()->user()){
            $users = User::all();
            return view('users',compact('users'));
        }
        return redirect('/');

    }

    public function lsChat(User $user)
    {
        if(auth()->user()){
            return view('lsChat',compact('user'));
        }
        return redirect('/');

    }

    public function lsMessages(User $user): Collection|array
    {
        $sender = auth()->user()->id;
        $poluchatel = $user->id;
        $myMassagesToUser = LsMessages::query()
            ->with('user')
            ->where('to_user_id',$poluchatel)
            ->where('user_id',$sender);
        $allMassages = LsMessages::query()
            ->with('user')
            ->where('user_id',$poluchatel)
            ->where('to_user_id',$sender)
            ->union($myMassagesToUser)
            ->orderBy('id')
            ->get();

        return $allMassages;
    }

    public function messages(): Collection|array
    {
        return Message::query()
            ->with('user')
            ->get();
    }

    public function sendLs(LsMessageFormRequest $request)
    {
        $data = $request->validated();
        if(!is_null($data['image'])){
            $path = '/public/upload/' . \Auth::id() . '/';
            $filename = $data['image']->getClientOriginalName();

            if (! Storage::putFileAs($path, $data['image'], $filename, 'public')) {
                Log::info('cant save image '. $path);
            }else{
                $fullUrl = Storage::url('upload/' . \Auth::id() . '/' . $filename);
                $data['image'] = $fullUrl;
                //$data['image'] = Storage::get($path.$data['image']);
            }
        }else{
            $data['image'] = '';
        }
        $message = $request->user()
            ->messagesLs()
            ->create($data);
        broadcast(new LsMessageSent($request->user(), $message));
        return $message;
    }

    public function send(MessageFormRequest $request)
    {
        $message = $request->user()
            ->messages()
            ->create($request->validated());

        broadcast(new MessageSent($request->user(), $message));

        return $message;
    }
}
