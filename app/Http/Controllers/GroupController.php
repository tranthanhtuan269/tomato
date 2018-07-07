<?php

namespace App\Http\Controllers;

use App\Events\GroupCreated;
use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
	public function show($id){
		$groups = [];
		$groups = Group::where('id', '=', $id)->get();
		$user = auth()->user();
        $type = \DB::table('group_user')->where('group_id', $id)->where('user_id', $user->id)->first();
        $user->type = $type->type;

		return view('group.show', ['groups' => $groups, 'user' => $user]);
	}

    public function store(Request $request)
    {
    	$date = date('Y-m-d H:i:s');

        // add group source team
        $group = new Group;
        $group->channel_id = request('channel');
        $group->name = 'test';
        $group->created_at = $date;
        $group->updated_at = $date;
        $group->save();

        // add user for source team
        $users = collect();
        $users1 = collect(request('users1'));
        $users2 = collect(request('users'));
        $users->push(auth()->user()->id);
        $group->users()->attach($users, ['type' => 0]);
        $group->users()->attach($users1, ['type' => 1]);
        $group->users()->attach($users2, ['type' => 2]);
        broadcast(new GroupCreated($group))->toOthers();
        return $group;
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
