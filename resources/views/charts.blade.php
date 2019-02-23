@extends('layout')
@section('content')
<div class="container">
<div class="row">
    @if($data['peserta']->count() <= 0)
    <div class="col-12">
        <div class="c-alert c-alert--warning u-mb-medium">
        <span class="c-alert__icon">
            <i class="feather icon-alert-triangle"></i>
        </span>
        <div class="c-alert__content">
            <h4 class="c-alert__title">Peserta belum ada yang terdaftar</h4>
            <br>
        </div>
    </div>
    </div>
    @else
    <div class="col-12">
      <div class="c-table-responsive@wide">
        <table class="c-table">
          <thead class="c-table__head">
            <tr class="c-table__row">
              <th class="c-table__cell c-table__cell--head">Nama</th>
              <th class="c-table__cell c-table__cell--head">NRP</th>
              <th class="c-table__cell c-table__cell--head">Paket</th>
              <th class="c-table__cell c-table__cell--head">Nilai</th>
              <th class="c-table__cell c-table__cell--head">Nilai Remedial</th>
              <th class="c-table__cell c-table__cell--head">Soal Yang Sedang Dikerjakan</th>
            </tr>
          </thead>
        @foreach($data['peserta'] as $peserta)
        <tbody>
            <tr class="c-table__row">
              <td class="c-table__cell">
                <div class="o-media">
                  <div class="o-media__body">
                  <h6>{{ $peserta->nama }}</h6>
                  </div>
                </div>
              </td>
            <td class="c-table__cell">{{ $peserta->nrp }}</td>
            <th class="c-table__cell">
              @if($peserta->Paket->Nama == NULL)
                <a class="c-badge c-badge--small c-badge--danger" href="#">Belum Ditentukan</a>
              @else
              <a class="c-badge c-badge--small c-badge--info" href="#">{{$peserta->Paket->nama}}</a>
              @endif
            </th>
            <th class="c-table__cell">
              @if($peserta->Nilai == NULL)
                <a class="c-badge c-badge--small c-badge--danger">Belum Selesai</a>
              @else
                <a class="c-badge c-badge--small c-badge--info">{{$peserta->Nilai}}</a>
              @endif
            </th>
            <th class="c-table__cell">
              @if($peserta->isRemedial)
                <a class="c-badge c-badge--small c-badge--info">{{$peserta->nilaiRemedial}}</a>
              @else
                <a class="c-badge c-badge--small c-badge--danger">Tidak Remedial</a>
              @endif
            </th>
            <th class="c-table__cell">
                @if($peserta->soal_terakhir-1 != 0)
                    <a class="c-badge c-badge--small c-badge--info">{{$peserta->soal_terakhir}}</a>
                @else
                    <a class="c-badge c-badge--small c-badge--danger">Belum Mengerjakan</a>
                @endif
            </th>
            </tr>
        </tbody>
        @endforeach
        </table>
      </div>
    </div>
    @endif
  </div>
</div>
</div>
@endsection