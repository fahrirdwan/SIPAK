<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <img src="/img/profil/{{ Auth::user()->picture }}" class="img-circle elevation-2" alt="User Image" width="30px">
        </li>
        <li class="nav-item">
            <a href="profil" class="d-block mt-1 ml-1">{{ Auth::user()->name }}</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-primary navbar-badge text-white">{{ $notif_keluar->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-item dropdown-header">Notifikasi Masuk
              </span>
              <div class="dropdown-divider"></div>
              @foreach($notif_keluar as $nm)
              
              {{-- JANGAN DIHAPUS! --}}
              @php
                $date = \Carbon\Carbon::now()->format('Y-m-d');
                $jatuh_tempo = \Carbon\Carbon::parse($nm->tgl_pengembalian)->format('Y-m-d');
                $date_now = \Carbon\Carbon::now()->format('d');
                $date_expired = \Carbon\Carbon::parse($nm->tgl_pengembalian)->format('d');
                $now = \Carbon\Carbon::now()->format('Y-m');
                $expired = \Carbon\Carbon::parse($nm->tgl_pengembalian)->format('Y-m');
              @endphp

              @if($date < $jatuh_tempo)
                @if($expired === $now)
                    @if($date_expired - $date_now === 3)
                    <a href="#" class="dropdown-item">
                        <p> anda harus mengembalikan aset {{ $nm->jenis_barang }} {{ $nm->nama_barang }} sebelum {{ \Carbon\Carbon::parse($nm->tgl_pengembalian)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                        <span class="float-right text-muted text-sm"></span></p>
                    </a>
                    @endif
                @endif
              @endif
              @endforeach
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">Selengkapnya</a>
            </div>
          </li>
          @php
          $chat_from_me = \DB::table('chats')
                              ->join('users','users.nip','=','chats.linked_user')
                              ->join('messages','messages.session_chat','=','chats.session_chat')
                              ->where('chats.nip_user', Auth::user()->nip)
                              ->where('messages.nip_user','!=', Auth::user()->nip)
                              ->orderBy('messages.created_at','desc')
                              ->select('users.name','users.picture','messages.*')
                              ->limit(2)->get();
          $chat_from_other = \DB::table('chats')
                                  ->join('users','users.nip','=','chats.nip_user')
                                  ->join('messages','messages.session_chat','=','chats.session_chat')
                                  ->where('chats.linked_user', Auth::user()->nip)
                                  ->where('messages.nip_user','!=', Auth::user()->nip)
                                  ->orderBy('messages.created_at','desc')
                                  ->select('users.name','users.picture','messages.*')
                                  ->limit(2)->get();

          $count_chat = $chat_from_me->count() + $chat_from_other->count();
          @endphp
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-comments"></i>
              <span class="badge badge-danger navbar-badge">{{ $count_chat }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            @foreach($chat_from_me as $chat)
            <a href="#" class="dropdown-item p-3">
              <b><img class="rounded-circle" src="/img/profil/{{ $chat->picture}}"
                width="25"> {{ $chat->name }}</b>
                <p>{{ $chat->message }}<br> {{ \Carbon\Carbon::parse($chat->created_at)->format('d F Y H:i') }}
              <span class="float-right text-muted text-sm"></span></p>
            </a>
            @endforeach
            @foreach($chat_from_other as $chat)
            <a href="#" class="dropdown-item p-3">
              <b><img class="rounded-circle" src="/img/profil/{{ $chat->picture}}"
                width="25"> {{ $chat->name }}</b>
                <p>{{ $chat->message }}<br> {{ \Carbon\Carbon::parse($chat->created_at)->format('d F Y H:i') }}
              <span class="float-right text-muted text-sm"></span></p>
            </a>
            @endforeach
              <a href="/{{ Request::segment(1) }}/chat" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/logout">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>