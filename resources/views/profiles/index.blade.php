@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://placekitten.com/400/400" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->username }}</h1>
                <a href="/p/create">Add new post</a>
            </div>
            
            <div class="d-flex">
                <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="pr-5"><strong>Fake</strong> followers</div>
                <div class="pr-5"><strong>Fake</strong> following</div>
            </div>
            
            <div class="pt-4 font-weight-bold">{{ $user->profile->title ?? '' }}</div>
            <div>{{ $user->profile->description ?? ''}}</div>
            <div><a href="#">{{ $user->profile->url ?? ''}}</a></div>
            
        </div>
    </div>
    
    <div class="row pt-4">
        @foreach ($user->posts as $post)
        <div class="col-4 p-3">
            <img src="/storage/{{ $post->image }}" class="w-100 p-3">
        </div>
        @endforeach
    </div>
    
</div>
@endsection