@extends('layouts.default')

@section('title','History')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @foreach($history as $hst)
            <div class="card shadow" style="border-radius: 20px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fas fa-history"></i> &nbsp; {{ $hst->pesan }}
                            <p class="mt-4">Status :
                                @if($hst->status === 'Diproses')
                                <span class="badge bg-primary">
                                    {{ $hst->status }}
                                </span> 
                                @elseif($hst->status === 'Dipinjam')
                                <span class="badge bg-success">
                                    {{ $hst->status }}
                                </span> 
                                @elseif($hst->status === 'Proses Pengembalian')
                                <span class="badge bg-warning">
                                    {{ $hst->status }}
                                </span> 
                                @else
                                <span class="badge bg-danger">
                                    {{ $hst->status }}
                                </span> 
                                @endif
                            </p>
                            <p>Tanggal Peminjaman : {{ \Carbon\Carbon::parse($hst->tgl_peminjaman)->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
                            <p>Tgl Pengembalian : {{ \Carbon\Carbon::parse($hst->tgl_pengembalian)->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
                            <p>Dibuat pada : {{ \Carbon\Carbon::parse($hst->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }} | Diperbarui pada : {{ \Carbon\Carbon::parse($hst->updated_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
                             
                        </div>
                        <hr>
                        <div class="col-4 text-right">
                            <img src="/img/aset/{{ $hst->gambar }}" class="img-fluid" width="150" >
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $history->links() }}
    </div>
</div>
@endsection