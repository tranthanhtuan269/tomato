<?php

namespace App\Http\Controllers;

use App\Events\ChannelCreated;
use App\User;
use App\Language;
use App\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function show($id)
    {
        $channel = Channel::find($id);
        $users = User::where('id', '<>', auth()->user()->id)->get();
        $user = auth()->user();

        $languages = Language::get();

        $channels = Channel::get();
        return view('channel.view', ['users' => $users, 'user' => $user, 'languages' => $languages, 'channel' => $channel, 'channels' => $channels]);
    }

    public function store(Request $request)
    {
        $channel                        = new Channel;
        $channel->name                  = $request->name;
        $channel->source_language       = $request->source_language;
        $channel->target_language1      = $request->target_language;
        $channel->target_language2      = $request->target_language2;
        $channel->save();
        return $channel;
    }

    public function store2()
    {
        $group = Group::create(['name' => request('name')]);

        $users = collect(request('users'));
        $users->push(auth()->user()->id);

        $group->users()->attach($users);

        broadcast(new GroupCreated($group))->toOthers();

        return $group;
    }
}
