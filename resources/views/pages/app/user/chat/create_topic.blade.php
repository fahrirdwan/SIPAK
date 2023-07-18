@extends('layouts.default')

@section('title', 'Chat')

@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/user/chat" class="btn btn-success ml-3">Kembali</a>
        <div class="col-lg-12 text-center">
            <img src="/img/profil/{{ $user->picture }}" class="img-fluid rounded-circle" width="100" height="100">
            <h2 class="mt-2">{{ $user->name }}</h2>
            <h3 class="mt-2">Session Chat : {{ $session_chat }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h3>Topik</h3>
            <div class="card shadow mt-3">
                <div class="card-body">
                    <form class="form-inline" action="/user/chat/store" method="POST">@csrf
                        <p>
                            <input type="text" class="form-control" size="60" name="topic_chat">&nbsp;&nbsp;
                            <input type="hidden" name="nip_user" value="{{ Auth::user()->nip }}">
                            <input type="hidden" name="session_chat" value="{{ $session_chat }}">
                            <input type="hidden" name="linked_user" value="{{ $user->nip }}">
                            <button class="btn btn-primary">Kirim</button>
                        </p>
                        @error('topic_chat')<p class="text-danger">{{ $message }}</p>@enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection