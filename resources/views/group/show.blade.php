@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <groups :initial-groups="{{ $groups }}" :user="{{ $user }}"></groups>
    </div>
</div>
@endsection
