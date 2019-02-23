@extends('layout')
@section('content')
<div class="container">
<div class="row">
    @if($data['paket']->count() <= 0)
    <div class="col-12">
        <div class="c-alert c-alert--warning u-mb-medium">
        <span class="c-alert__icon">
            <i class="feather icon-alert-triangle"></i>
        </span>
        <div class="c-alert__content">
            <h4 class="c-alert__title">Paket belum tersedia untuk section ini</h4>
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
              <th class="c-table__cell c-table__cell--head">Nama Paket</th>
              <th class="c-table__cell c-table__cell--head">Keterangan</th>
              <th class="c-table__cell c-table__cell--head">Jumlah Soal</th>
              <th class="c-table__cell c-table__cell--head">Pilihan Ganda</th>
              <th class="c-table__cell c-table__cell--head">Mencocokan</th>
              <th class="c-table__cell c-table__cell--head">Benar Salah</th>
              <th class="c-table__cell c-table__cell--head">Actions</th>
            </tr>
          </thead>
        @foreach($data['paket'] as $paket)
        <tbody>
            <tr class="c-table__row">
              <td class="c-table__cell">
                <div class="o-media">
                  <div class="o-media__body">
                  <h6>{{ $paket->nama }}</h6>
                  </div>
                </div>
              </td>
            <td class="c-table__cell">
              @if($paket->keterangan != NULL)
                {{ $paket->keterangan }}
              @else
              <span class="c-badge c-badge--danger">Tidak ada keterangan</span>
              @endif
            </td>
            <td class="c-table__cell">
              <span class="c-badge c-badge--success">{{ $paket->jumlah_soal }}</span>
            </td>
            <th class="c-table__cell">
              <span class="c-badge c-badge--info">{{ $paket->jumlah_pilihan_ganda }}</span>
            </th>
            <th class="c-table__cell">
              <span class="c-badge c-badge--info">{{ $paket->jumlah_benar_salah }}</span>
            </th>
            <th class="c-table__cell">
                <span class="c-badge c-badge--info">{{ $paket->jumlah_mencocokan }}</span>
            </th>
              <td class="c-table__cell">
                <div class="c-dropdown dropdown">
                  <a href="#" class="c-btn c-btn--info has-icon dropdown-toggle" id="dropdownMenuTable1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pilihan <i class="feather icon-chevron-down"></i>
                  </a>

                  <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuTable1">
                  <a class="c-dropdown__item dropdown-item" href="{{url('pilihpaketpeserta/'.$data['peserta']->id.'/'.$paket->id)}}">Gunakan Paket Ini</a>
                  </div>
                </div>
              </td>
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