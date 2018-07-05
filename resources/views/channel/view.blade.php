@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <create-group :initial-users="{{ $users }}" :channel="{{ $channel }}"></create-group>
        </div>
    </div>
</div>
@endsection
