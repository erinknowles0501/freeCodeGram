@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://placekitten.com/400/400" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            
            <div><h1>Erin's CloneGram</h1></div>
            
            <div class="d-flex">
                <div class="pr-5"><strong>Fake</strong> posts</div>
                <div class="pr-5"><strong>Fake</strong> followers</div>
                <div class="pr-5"><strong>Fake</strong> following</div>
            </div>
            
        </div>
    </div>
    
    <div class="row pt-4">
        <div class="col-4">
            <img src="https://placekitten.com/400/200" class="w-100 p-3">
        </div>
        <div class="col-4">
            <img src="https://placekitten.com/500/600" class="w-100 p-3">
        </div>
        <div class="col-4">
            <img src="https://placekitten.com/300/500" class="w-100 p-3">
        </div>
    </div>
    
</div>
@endsection
