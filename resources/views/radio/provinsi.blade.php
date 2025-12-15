@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Radio di {{ $provinsi->nama }}</h2>
            <p class="text-muted">Kode Provinsi: {{ $provinsi->kode }}</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    @if($radios->count() > 0)
        <div class="row">
            @foreach($radios as $radio)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm hover-shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            @if($radio->foto)
                                <img src="{{ Storage::url($radio->foto) }}" 
                                     alt="{{ $radio->nama_radio }}" 
                                     class="rounded me-3"
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                     style="width: 80px; height: 80px;">
                                    <i class="bi bi-broadcast text-muted" style="font-size: 2rem;"></i>
                                </div>
                            @endif
                            
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">{{ $radio->nama_radio }}</h5>
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-person"></i> {{ $radio->nama }}
                                </p>
                                <p class="mb-1 small">
                                    <i class="bi bi-geo-alt text-primary"></i> {{ $radio->alamat }}
                                </p>
                                <p class="mb-1 small">
                                    <i class="bi bi-telephone text-success"></i> {{ $radio->no_telpon }}
                                </p>
                                <p class="mb-0 small">
                                    <i class="bi bi-envelope text-danger"></i> {{ $radio->email }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top">
                        <div class="d-flex gap-2">
                            <a href="{{ route('radio.edit', $radio->id) }}" 
                               class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('radio.destroy', $radio->id) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $radios->links() }}
        </div>
    @else
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle me-2"></i>
            Belum ada data radio untuk provinsi {{ $provinsi->nama }}
        </div>
    @endif
</div>

<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection