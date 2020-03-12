@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-4 offset-2">
            <img src="/storage/{{ $post -> image }}" class="w-100">
        </div>
        <div class="col-4">
            <div class="d-flex align-items-center">
                <div class="pr-3">
                    <img src="{{ $post -> user -> profile -> profileImage() }}" class="rounded-circle w-100" style = "max-width: 5vh">
                </div>
                <div class="font-weight-bold">
                    <a href="/profile/{{$post -> user -> id }}">
                        <span class= "text-dark" >{{$post -> user -> username}}</span>
                    </a>
                    <a href="#" class="pl-3">Follow</a>
                </div>
            </div>
            <hr>
            <p>
                <span class="font-weight-bold">
                    <a href="/profile/{{$post -> user -> id }}">
                        <span class= "text-dark" >{{$post -> user -> username}}</span>
                    </a>
                </span>
                {{ $post -> caption }}
            </p>
        </div>
    </div>
</div>
@endsection
