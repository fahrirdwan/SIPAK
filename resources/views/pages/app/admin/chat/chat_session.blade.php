@extends('layouts.default')

@section('title', 'Chat')

@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/admin/chat" class="btn btn-success ml-3">Kembali</a>
        <div class="col-lg-12 text-center">
            <img src="/img/profil/{{ $user->picture }}" class="img-fluid rounded-circle" width="150" height="250">
            <h2 class="mt-2">
                @if($status_chat === 'From Me')
                To : 
                @else
                From : 
                @endif
                {{ $user->name }}</h2>
            <p>Topik : {{ $user->topic_chat }}</p>
        </div>
    </div>
    <div class="row">
        @foreach($messages as $message)
        <div class="col-lg-8 mx-auto">
            <div class="card shadow mt-3">
                <div class="card-header">
                    {{ $message->name }}
                </div>
                <div class="card-body">
                    {{ $message->message }}
                </div>
                <div class="card-footer">
                    {{ \Carbon\Carbon::parse($message->created_at)->format('d F Y H:i') }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow mt-3">
                <div class="card-body">
                    <form class="form-inline" action="/admin/chat/session/{{ $user->session_chat }}" method="POST">@csrf
                        <input type="hidden" name="session_chat" value="{{ $user->session_chat }}">
                        <input type="text" class="form-control" size="60" name="message" id="message">&nbsp;&nbsp;
                        <button class="btn btn-primary">Kirim</button>
                        @error('message')<p class="text-danger">{{ $message }}</p>@enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection