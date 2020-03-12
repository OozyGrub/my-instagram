@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
    <div class="col-6 offset-3 pt-5">
        <div class="row">
            <div class="align-items-center">
                <div class="d-flex align-items-center">
                    <div class="pr-3">
                        <img src="{{ $post -> user -> profile -> profileImage() }}" class="rounded-circle w-100" style = "max-width: 5vh">
                    </div>
                    <a href="/profile/{{$post -> user -> id }}">
                        <span class= "text-dark" >{{$post -> user -> username}}</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row pt-3">
                <img src="/storage/{{ $post -> image }}" class="w-100">
        </div>
        <div class="pt-3">
            <p>
                <span class="font-weight-bold">
                    <a href="/profile/{{$post -> user -> id }}">
                        <span class= "text-dark" >{{$post -> user -> username}}</span>
                    </a>
                </span>
                {{ $post -> caption }}
            </p>
        </div>
        <div class="pt-5"></div>
        <hr>
    </div>
    @endforeach
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts -> links() }}
        </div>
    </div>
</div>
@endsection
