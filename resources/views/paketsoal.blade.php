@extends('layout')
@section('content')
<div class="container">
<div class="row">
    @if(session()->has('pesan_sukses'))
    <div class="col-12">
      <div class="c-alert c-alert--success u-mb-medium">
        <span class="c-alert__icon">
          <i class="feather icon-check"></i>
        </span>
        <div class="c-alert__content">
        <h4 class="c-alert__title">{{ session()->get('pesan_sukses') }}</h4>
        </div>
      </div>
    </div>
    @endif
    @if($data['paket']->count() <= 0)
    <div class="col-12">
        <div class="c-alert c-alert--warning u-mb-medium">
        <span class="c-alert__icon">
            <i class="feather icon-alert-triangle"></i>
        </span>
        <div class="c-alert__content">
            <h4 class="c-alert__title">Paket belum tersedia !</h4>
            <p>Silahkan tambah paket terlebih dahulu</p>
            <br>
            <a class="c-btn c-btn--success u-mb-xsmall" href="{{ url('tambahpaketsoal/'.$data['id']) }}">Tambah Paket Soal</a>
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
              @if($paket->keterangan == NULL)
                <a class="c-badge c-badge--small c-badge--danger">Tidak ada keterangan</a>
              @else
                {{$paket->keterangan}}
              @endif
            </td>
            <th class="c-table__cell">{{ $paket->jumlah_soal }}</th>
              <td class="c-table__cell">
                <div class="c-dropdown dropdown">
                  <a href="#" class="c-btn c-btn--info has-icon dropdown-toggle" id="dropdownMenuTable1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pilihan <i class="feather icon-chevron-down"></i>
                  </a>

                  <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuTable1">
                    <a class="c-dropdown__item dropdown-item" href="#">Lihat Soal</a>
                    <a class="c-dropdown__item dropdown-item" href="#">Ubah Soal</a>
                    <a class="c-dropdown__item dropdown-item" href="{{ url('hapuspaketsoal/'.$paket->id) }}">Hapus</a>
                  </div>
                </div>
              </td>
            </tr>
        </tbody>
        @endforeach
        </table>
      </div>
    </div>
    <div class="col-5"></div>
    <div class="col-2">
    <br>
    <a class="c-btn c-btn--success u-mb-xsmall" href="{{ url('tambahpaketsoal/'.$data['id']) }}">Tambah Paket Soal</a>
    </div>
    <div class="col-5"></div>
    @endif
  </div>
</div>
@endsection