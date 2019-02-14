@extends('layout')
@section('content')
<div class="container">
<div class="row">
    @if($data['section']->count() <= 0)
    <div class="col-12">
        <div class="c-alert c-alert--warning u-mb-medium">
        <span class="c-alert__icon">
            <i class="feather icon-alert-triangle"></i>
        </span>
        <div class="c-alert__content">
            <h4 class="c-alert__title">Section belum tersedia !</h4>
            <p>Silahkan tambah section terlebih dahulu</p>
            <br>
            <button class="c-btn c-btn--success u-mb-xsmall">Tambah Section</button>
        </div>
    </div>
    </div>
    @else
    <div class="col-12">
      <div class="c-table-responsive@wide">
        <table class="c-table">
          <thead class="c-table__head">
            <tr class="c-table__row">
              <th class="c-table__cell c-table__cell--head">Nama Section</th>
              <th class="c-table__cell c-table__cell--head">Keterangan</th>
              <th class="c-table__cell c-table__cell--head">Tanggal Dibuat</th>
              <th class="c-table__cell c-table__cell--head">Actions</th>
            </tr>
          </thead>
        @foreach($data['section'] as $section)
        <tbody>
            <tr class="c-table__row">
              <td class="c-table__cell">
                <div class="o-media">
                  <div class="o-media__body">
                  <h6>{{ $section->nama }}</h6>
                  </div>
                </div>
              </td>
            <td class="c-table__cell">{{ $section->keterangan }}</td>
            <th class="c-table__cell">{{ $section->created_at }}</th>
              <td class="c-table__cell">
                <div class="c-dropdown dropdown">
                  <a href="#" class="c-btn c-btn--info has-icon dropdown-toggle" id="dropdownMenuTable1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pilihan <i class="feather icon-chevron-down"></i>
                  </a>

                  <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuTable1">
                    <a class="c-dropdown__item dropdown-item" href="#">Hapus</a>
                    <a class="c-dropdown__item dropdown-item" href="#">Ubah</a>
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
        <button class="c-btn c-btn--success u-mb-xsmall">Tambah Section</button>
    </div>
    <div class="col-5"></div>
    @endif
  </div>
</div>
@endsection