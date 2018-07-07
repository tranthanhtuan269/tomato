<?php

namespace App\Http\Controllers;

use App\Events\GroupCreated;
use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
	public function show($id){
		$groups = [];
		$group = Group::find($id);
		if($group->name == "Source team"){
			$groups = Group::where('id', '=', $id)->get();
		}else if($group->name == "Target team"){
			$groups = Group::where('channel_id', '=', $group->channel_id)->get();
		}
		// $groups = auth()->user()->groups;
		$user = auth()->user();
		return view('group.show', ['groups' => $groups, 'user' => $user]);
	}

    public function store(Request $request)
    {
    	$date = date('Y-m-d H:i:s');

        // add group source team
        $group = new Group;
        $group->name = request('name');
        $group->channel_id = request('channel');
        $group->created_at = $date;
        $group->updated_at = $date;
        $group->save();

        // add user for source team
        $users = collect(request('users'));
        $users->push(auth()->user()->id);
        $group->users()->attach($users);
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
