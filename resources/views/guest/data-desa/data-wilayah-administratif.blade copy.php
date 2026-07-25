@extends('layouts.main')


@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-12 mb-3">
            <div class="card text-white bg-success mb-2">
                <h5 class="card-text d-flex justify-content-center p-2 fs-2 fw-bold" style="color:white;border-radius: 30px;">
                    DATA WILAYAH ADMINISTRATIF
                </h5>
            </div>
            <div class="row ">
                <div class="card p-0 overflow-hidden">
                    <div class="card-body">
                        <table class="table table-bordered fs--1 mb-0">
                            <thead class="bg-200 text-900">
                                <tr>
                                    <th>Nama Dusun</th>
                                    <th>RW</th>
                                    <th>RT</th>
                                    <th>Nama Kepala/Ketua</th>
                                    <th>Jumlah Penduduk</th>
                                    <th>L</th>
                                    <th>P</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $cekdusun = true;
                                    $cekrw = true;
                                @endphp
                                @foreach ($dusun as $dusun)
                                    @forelse ($dusun->rw as $rw)
                                        @forelse ($rw->rt as $rt)
                                            <tr>
                                                @if ($cekdusun)
                                                    @php
                                                        $cekdusun = false;
                                                    @endphp
                                                    <td>{{ $dusun->nama }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if ($cekrw)
                                                    @php
                                                        $cekrw = false;
                                                    @endphp
                                                    <td>{{ $rw->rw }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td>{{ $rt->rt }}</td>
                                                <td>{{ $rt->ketuaRT->nama ?? '-' }}</td>
                                                <td>{{ count($rt->penduduk) ?? '0' }}</td>
                                                <td>{{ count($rt->penduduk()->where('jenisKelamin', 'Laki-laki')->get()) ?? '0' }}</td>
                                                <td>{{ count($rt->penduduk()->where('jenisKelamin', 'Perempuan')->get()) ?? '0' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                @if ($cekdusun)
                                                    @php
                                                        $cekdusun = false;
                                                    @endphp
                                                    <td>{{ $dusun->nama }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if ($cekrw)
                                                    @php
                                                        $cekrw = false;
                                                    @endphp
                                                    <td>{{ $rw->rw }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td>-</td>
                                                <td>{{ $rw->ketuaRT->nama ?? '-' }}</td>
                                                <td>{{ count($rw->penduduk) ?? '0' }}</td>
                                                <td>{{ count($rw->penduduk()->where('jenisKelamin', 'Laki-laki')->get()) ?? '0' }}</td>
                                                <td>{{ count($rw->penduduk()->where('jenisKelamin', 'Perempuan')->get()) ?? '0' }}</td>
                                            </tr>
                                        @endforelse
                                        <tr>
                                            <td></td>
                                            <td colspan="2" class="bg-500">{{ $rw->rw }}</td>
                                            <td>{{ $rw->ketuaRW->nama??'-' }}</td>
                                        </tr>
                                        @php
                                            $cekrw = true;
                                        @endphp
                                    @empty
                                        <tr>
                                            @if ($cekdusun)
                                                @php
                                                    $cekdusun = false;
                                                @endphp
                                                <td>{{ $dusun->nama }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>-</td>
                                            <td>-</td>
                                            <td>{{ $dusun->kepalaDusun->nama ?? '-' }}</td>
                                            <td>{{ count($dusun->penduduk) ?? '0' }}</td>
                                            <td>{{ count($dusun->penduduk()->where('jenisKelamin', 'Laki-laki')->get()) ?? '0' }}</td>
                                            <td>{{ count($dusun->penduduk()->where('jenisKelamin', 'Perempuan')->get()) ?? '0' }}</td>

                                        </tr>
                                    @endforelse
                                    <tr>
                                        <td colspan="3" class="bg-200">{{ $dusun->nama }}</td>
                                        <td>{{ $dusun->kepalaDusun->nama??'-' }}</td>
                                    </tr>
                                    @php
                                        $cekdusun = true;
                                    @endphp
                                @endforeach
                                <tr>
                                    <td colspan=""></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
        @include('components.side-guest.side-guest')
    </div>
@endsection
