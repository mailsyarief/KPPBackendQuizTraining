@extends('layout')
@section('content')
<div class="container"><div class="row">
<div class="col-12">
        <nav class="c-tabs"> 
          <div class="c-tabs__list nav nav-tabs" id="myTab" role="tablist">
            <a class="c-tabs__link active show" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
              <span class="c-tabs__link-icon">
              </span>Detil Akun
            </a>
            <a class="c-tabs__link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
              <span class="c-tabs__link-icon">
              </span>Jawaban Pilihan Ganda
            </a>
          </div>
          <div class="c-tabs__content tab-content" id="nav-tabContent">
            <div class="c-tabs__pane active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">


              <div class="row">
                <div class="col-xl-6">
                  <div class="c-field u-mb-medium">
                    <label class="c-field__label" for="user-name">Nama</label>
                    <input class="c-input" type="text" id="user-name" value={{$data['peserta']->nama}} disabled>
                  </div>

                  <div class="c-field u-mb-medium">
                    <label class="c-field__label" for="user-email">NRP</label>
                    <input class="c-input" type="text" id="user-email" value="{{$data['peserta']->nrp}}" disabled>
                  </div>
                  <div class="c-field u-mb-medium">
                    <label class="c-field__label" for="user-phone">Section</label>
                    <input class="c-input" type="text" id="user-phone" value="{{$data['peserta']->section}}" disabled>
                  </div>
                </div>
                <div class="col-xl-6">
                    <div class="c-field u-mb-medium">
                      <label class="c-field__label" for="user-name">Token</label>
                      <input class="c-input" type="text" id="user-name" value={{$data['peserta']->token}} disabled>
                    </div>
  
                    <div class="c-field u-mb-medium">
                      <label class="c-field__label" for="user-email">No. Soal Terakhir Dikerjakan</label>
                      <input class="c-input" type="text" id="user-email" value="{{$data['peserta']->soal_terakhir}}" disabled>
                    </div>
                    <div class="c-field u-mb-medium">
                      <label class="c-field__label" for="user-phone">Paket yang Dikerjakan</label>
                    <input class="c-input" type="text" id="user-phone" value="{{ $data['peserta']->Paket->nama}}" disabled>
                    </div>
                  </div>
              </div>
              <span class="c-divider u-mv-medium"></span>
            </div>

            <div class="c-tabs__pane" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                @if($data['peserta']->paket_id == NULL)
                                <div class="col-12">
                                    <div class="c-alert c-alert--warning u-mb-medium">
                                    <span class="c-alert__icon">
                                        <i class="feather icon-alert-triangle"></i>
                                    </span>
                                    <div class="c-alert__content">
                                        <h4 class="c-alert__title">Paket Belum Ditentukan oleh Admin</h4>
                                        <br>
                                    </div>
                                </div>
                @endif
                                {{-- <div class="col-12"> --}}
                                  {{-- <div class="c-table-responsive@wide"> --}}
                                    <table class="c-table">
                                      <thead class="c-table__head">
                                        <tr class="c-table__row">
                                          <th class="c-table__cell c-table__cell--head">Soal</th>
                                          <th class="c-table__cell c-table__cell--head">Jawaban Peserta</th>
                                          <th class="c-table__cell c-table__cell--head">Kunci Jawaban</th>
                                          <th class="c-table__cell c-table__cell--head">Status</th>
                                        </tr>
                                      </thead>
                                    <tbody>
                                      {{-- pilihan ganda --}}
                                      @foreach($data['pilihanganda'] as $pilgan)
                                        <tr class="c-table__row">
                                          <td class="c-table__cell">
                                            <div class="o-media">
                                              <div class="o-media__body">
                                              <h6>{{$pilgan->soal}}</h6>
                                              </div>
                                            </div>
                                          </td>
                                        <th class="c-table__cell">
                                            @if($data['soal']->find($pilgan->id)->first()->JawabanPesertaPilihanGanda()->wherePivot('soal_id', $pilgan->id)->first()->jawaban_peserta == NULL)
                                            <a class="c-badge c-badge--small c-badge--danger" href="#">
                                              Belum Dijawab
                                            </a>
                                            @else
                                            <a class="c-badge c-badge--small c-badge--success" href="#">
                                              {{ $data['soal']->find($pilgan->id)->first()->JawabanPesertaPilihanGanda()->first()->pivot->jawaban_peserta }}
                                            </a>
                                            @endif
                                        </th>
                                        <th class="c-table__cell">
                                            <a class="c-badge c-badge--small c-badge--danger" href="#">
                                              {{-- {{ $pilgan->JawabanPesertaPilihanGanda->id }} --}}
                                              {{ $pilgan->JawabanPilihanGanda->first()->jawaban }}
                                            </a>
                                        </th>
                                        <th class="c-table__cell">
                                            <a class="c-badge c-badge--small c-badge--danger">-</a>
                                        </th>
                                        </tr>
                                      @endforeach
                                      {{-- end pilihan ganda --}}
                                      {{-- mencocokan --}}
                                      {{-- @foreach($data['mencocokan'] as $mencocokan)
                                        <tr class="c-table__row">
                                          <td class="c-table__cell">
                                            <div class="o-media">
                                              <div class="o-media__body">
                                              <h6>{{$mencocokan->soal}}</h6>
                                              </div>
                                            </div>
                                          </td>
                                        <th class="c-table__cell">
                                            @if($data['soal']->find($mencocokan->id)->first()->JawabanPesertaMencocokan()->first()->pivot->jawaban_peserta == NULL)
                                            <a class="c-badge c-badge--small c-badge--danger" href="#">
                                              Belum Dijawab
                                            </a>
                                            @else
                                            <a class="c-badge c-badge--small c-badge--success" href="#">
                                              {{ $data['soal']->find($mencocokan->id)->first()->JawabanPesertaMencocokan()->first()->pivot->jawaban_peserta }}
                                            </a>
                                            @endif
                                        </th>
                                        <th class="c-table__cell">
                                            <a class="c-badge c-badge--small c-badge--danger" href="#">
                                              {{-- {{ $pilgan->JawabanPesertaPilihanGanda->id }} --}}
                                              {{-- {{$pilgan->id}}
                                            </a>
                                        </th>
                                        <th class="c-table__cell">
                                            <a class="c-badge c-badge--small c-badge--danger">-</a>
                                        </th>
                                        </tr>
                                      @endforeach --}} --}}
                                      {{-- end mencocokan --}}
                                      {{-- benar salah --}}
                                      {{-- @foreach($data['benarsalah'] as $benarsalah)
                                        <tr class="c-table__row">
                                          <td class="c-table__cell">
                                            <div class="o-media">
                                              <div class="o-media__body">
                                              <h6>{{$benarsalah->soal}}</h6>
                                              </div>
                                            </div>
                                          </td>
                                        <th class="c-table__cell">
                                            @if($data['soal']->find($benarsalah->id)->first()->JawabanPesertaBenarSalah()->first()->pivot->jawaban_peserta == NULL)
                                            <a class="c-badge c-badge--small c-badge--danger" href="#">
                                              Belum Dijawab
                                            </a>
                                            @else
                                            <a class="c-badge c-badge--small c-badge--success" href="#">
                                              {{ $data['soal']->find($benarsalah->id)->first()->JawabanPesertaBenarSalah()->first()->pivot->jawaban_peserta }}
                                            </a>
                                            @endif
                                        </th>
                                        <th class="c-table__cell">
                                            <a class="c-badge c-badge--small c-badge--danger" href="#">
                                              {{-- {{ $pilgan->JawabanPesertaPilihanGanda->id }} --}}
                                              {{-- {{$benarsalah->id}}
                                            </a>
                                        </th>
                                        <th class="c-table__cell">
                                            <a class="c-badge c-badge--small c-badge--danger">-</a>
                                        </th>
                                        </tr> --}}
                                      {{-- @endforeach --}}
                                    </tbody>
                                    </table>
                                  {{-- </div> --}}
                                {{-- </div> --}}

            </div>
          </div>
        </nav>
      </div>
    </div></div>
@endsection