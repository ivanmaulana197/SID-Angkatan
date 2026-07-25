<div class="card text-white bg-success mb-2">
    <div class="card-text d-flex justify-content-center p-2 fs-2 fw-bolder" style="color:white">
        AGENDA TERBARU
    </div>
</div>

<div class="card mb-3 mb-lg-0">
    <div class="card-body fs--1">
        @forelse ($myData['agenda'] as $data)
            <div class="d-flex btn-reveal-trigger">
                <div class="calendar">
                    <span class="calendar-month">{{ date('M', strtotime($data->tanggal_agenda)) }}</span>
                    <span class="calendar-day">{{ date('d', strtotime($data->tanggal_agenda)) }}</span>
                </div>
                <div class="flex-1 position-relative ps-3">
                    <h6 class="fs-0 mb-0">
                        <a href="{{ route('agenda.show',$data->id) }}">{{ $data->nama }}</a>
                    </h6>

                    <p class="text-1000 mb-0">{{ Str::words(strip_tags($data->keterangan), 20) }}</p>
                    @php
                        $date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->tanggal_agenda)->locale('id_ID');
                        $formattedDate = $date->isoFormat('dddd, HH:mm, D MMMM YYYY');
                    @endphp

                    {{ $formattedDate }}
                    <div class="border-bottom border-dashed my-3"></div>
                </div>
            </div>
        @empty
            <div class="text-center">
                <h6>Belum Ada Agenda</h6>
            </div>
        @endforelse
    </div>
    <div class="card-footer bg-light p-0 border-top">
        <a class="btn btn-success d-block w-100" href="{{ route('agenda') }}">Agenda Lainnya<span class="fas fa-chevron-right ms-1 fs--2"></span></a>
    </div>
</div>
