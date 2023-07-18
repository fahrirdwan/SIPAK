@extends('layouts.default')

@section('title', 'Chat')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
          <h3>Recent Chat</h3>
        </div>
        @foreach($chat_from_me as $chat)
        @php
        $count_chat = DB::table('messages')->where('session_chat', $chat->session_chat)->count();
        @endphp
        <div class="col-lg-8 mx-auto">
            <div class="card shadow mt-3">
                <div class="card-body">
                  <img src="/img/profil/{{ $chat->picture }}" class="img-fluid rounded-circle" width="80">&nbsp; To : {{ $chat->name }} <span class="badge bg-success text-white"><i class="fas fa-comment"></i> {{ $count_chat }}</span>
                  <p class="mt-3">Topik : {{ $chat->topic_chat }} <a href="/user/chat/session/{{ $chat->session_chat }}" class="badge bg-primary text-white">lanjutkan chat</a></p>
                  <p>{{ \Carbon\Carbon::parse($chat->created_at)->format('d F Y H:i') }}</p>
                </div>
            </div>
        </div>
        @endforeach
        @foreach($chat_from_other as $chat)
        @php
        $count_chat = DB::table('messages')->where('session_chat', $chat->session_chat)->count();
        @endphp
        <div class="col-lg-8 mx-auto">
            <div class="card shadow mt-3">
                <div class="card-body">
                  <img src="/img/profil/{{ $chat->picture }}" class="img-fluid rounded-circle" width="80">&nbsp; From : {{ $chat->name }} <span class="badge bg-success text-white"><i class="fas fa-comment"></i> {{ $count_chat }}</span> 
                  <p class="mt-3">Topik : {{ $chat->topic_chat }} <a href="/user/chat/linked_session/{{ $chat->session_chat }}" class="badge bg-primary text-white">lanjutkan chat</a></p>
                  <p>{{ \Carbon\Carbon::parse($chat->created_at)->format('d F Y H:i') }}</p>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-lg-12 text-center">
            <button type="button" class="btn btn-lg rounded-circle btn-success mt-4" data-toggle="modal" data-target="#startChat">+</button>
        </div>
    </div>
</div>

<!-- Modal forms-->
<div class="modal fade" id="startChat" tabindex="-1" role="dialog" aria-labelledby="startChat" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pilih</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                @foreach($users as $user)
                @if($user->name !== Auth::user()->name)
                <div class="col-8 mb-5">
                    <img src="/img/profil/{{ $user->picture }}" class="img-fluid rounded-circle" width="80"> {{ $user->name }} <a href="/user/chat/{{ $user->name }}/{{ rand(0, 10000000) }}" class="badge bg-success text-white">mulai chat</a>
                </div>
                <hr/>
                @endif
                @endforeach
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection