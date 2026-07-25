@extends('layouts.main')

@section('content')
    @include('layanan-mandiri.component.header')

    <div class="row">
        <div class="col-md-3 col-sm-5 mb-3">
            @include('layanan-mandiri.component.card-profile')
        </div>
        <div class="col-md-9 col-sm-7">
            <form action="{{ route('layanan-mandiri.update-pin') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Ganti PIN</div>
                    </div>
                    <div class="card-body bg-light">
                        <div class="mb-3">
                            <label for="pin_lama" class="form-label">PIN Lama</label>
                            <input class="form-control @error('pin_lama') is-invalid @enderror" id="pin_lama" type="password" name="pin_lama" required autofocus value="{{ old('pin_lama') }}" maxlength="6">
                            @error('pin_lama')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
        
                        <div class="mb-3">
                            <label class="form-label" for="pin_baru">PIN Baru</label>
                            <input class="form-control @error('pin_baru') is-invalid @enderror" id="pin_baru" type="password" name="pin_baru" required value="{{ old('pin_baru') }}" maxlength="6">
                            @error('pin_baru')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
        
                        <div class="mb-3">
                            <label class="form-label" for="konfirmasi_pin_baru">Konfirmasi PIN Baru</label>
                            <input class="form-control @error('konfirmasi_pin_baru') is-invalid @enderror" id="konfirmasi_pin_baru" type="password" name="konfirmasi_pin_baru" required value="{{ old('konfirmasi_pin_baru') }}" maxlength="6">
                            @error('konfirmasi_pin_baru')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-sm btn-falcon-default me-3" href="{{ route('layanan-mandiri') }}">Kembali</a>
                        <button class="btn btn-sm btn-success" type="submit">Ganti PIN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
