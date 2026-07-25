@extends('layouts.main')


@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-12 mb-3">
            @include('guest.home.components.data-statistik-penduduk')
            <div class="card text-white bg-success mb-2">
                <h5 class="card-text d-flex justify-content-center p-2 fs-2 fw-bold" style="color:white;border-radius: 30px;">
                    DATA WILAYAH ADMINISTRATIF
                </h5>
            </div>

            <div class="card p-0 overflow-hidden">
                <div class="card-body">
                    <div class="table-responsive scrollbar">
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
                                    <tr>
                                        <td colspan="3" class="bg-400 text-white">{{ $dusun->nama }}</td>
                                        <td>{{ $dusun->kepalaDusun->nama ?? '-' }}</td>
                                        <td>{{ count($dusun->penduduk) ?? '0' }}</td>
                                        <td>{{ count($dusun->penduduk()->where('jenisKelamin', 'Laki-laki')->get()) ?? '0' }}</td>
                                        <td>{{ count($dusun->penduduk()->where('jenisKelamin', 'Perempuan')->get()) ?? '0' }}</td>
                                    </tr>
                                    @forelse ($dusun->rw as $rw)
                                        <tr>
                                            <td>{{ $dusun->nama }}</td>
                                            <td colspan="2" class="bg-300">{{ $rw->rw }}</td>
                                            <td>{{ $rw->ketuaRW->nama ?? '-' }}</td>
                                            <td>{{ count($rw->penduduk) ?? '0' }}</td>
                                            <td>{{ count($rw->penduduk()->where('jenisKelamin', 'Laki-laki')->get()) ?? '0' }}</td>
                                            <td>{{ count($rw->penduduk()->where('jenisKelamin', 'Perempuan')->get()) ?? '0' }}</td>
                                        </tr>
                                        @forelse ($rw->rt as $rt)
                                            <tr>
                                                <td>{{ $dusun->nama }}</td>
                                                <td>{{ $rw->rw }}</td>
                                                <td class="bg-200">{{ $rt->rt }}</td>
                                                <td>{{ $rt->ketuaRT->nama ?? '-' }}</td>
                                                <td>{{ count($rt->penduduk) ?? '0' }}</td>
                                                <td>{{ count($rt->penduduk()->where('jenisKelamin', 'Laki-laki')->get()) ?? '0' }}</td>
                                                <td>{{ count($rt->penduduk()->where('jenisKelamin', 'Perempuan')->get()) ?? '0' }}</td>
                                            </tr>
                                        @empty
                                        @endforelse


                                    @empty
                                    @endforelse

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
