@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Edit Data Organisasi
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('organisasi.update', $organisasi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="foto" class="form-label fw-semibold">
                                <i class="bi bi-image"></i> Foto
                            </label>
                            
                            @if($organisasi->foto)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($organisasi->foto) }}" 
                                         alt="Foto saat ini" 
                                         class="img-thumbnail"
                                         style="max-width: 200px;">
                                    <p class="text-muted small mt-1">Foto saat ini</p>
                                </div>
                            @endif
                            
                            <input type="file" 
                                   class="form-control @error('foto') is-invalid @enderror" 
                                   id="foto" 
                                   name="foto"
                                   accept="image/*"
                                   onchange="previewImage(event)">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto</small>
                            
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <p class="text-muted small">Preview foto baru:</p>
                                <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nama_organisasi" class="form-label fw-semibold">
                                <i class="bi bi-building"></i> Nama Organisasi <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama_organisasi') is-invalid @enderror" 
                                   id="nama_organisasi" 
                                   name="nama_organisasi" 
                                   value="{{ old('nama_organisasi', $organisasi->nama_organisasi) }}"
                                   required>
                            @error('nama_organisasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold">
                                <i class="bi bi-person"></i> Nama Penanggung Jawab <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" 
                                   name="nama" 
                                   value="{{ old('nama', $organisasi->nama) }}"
                                   required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-semibold">
                                <i class="bi bi-geo-alt"></i> Alamat <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                      id="alamat" 
                                      name="alamat" 
                                      rows="3"
                                      required>{{ old('alamat', $organisasi->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_telpon" class="form-label fw-semibold">
                                <i class="bi bi-telephone"></i> No. Telepon <span class="text-danger">*</span>
                            </label>
                            <input type="tel" 
                                   class="form-control @error('no_telpon') is-invalid @enderror" 
                                   id="no_telpon" 
                                   name="no_telpon" 
                                   value="{{ old('no_telpon', $organisasi->no_telpon) }}"
                                   required>
                            @error('no_telpon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope"></i> Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $organisasi->email) }}"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save"></i> Update
                            </button>
                            <a href="{{ route('organisasi.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
    }
}
</script>
@endsection