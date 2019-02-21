@extends('layout')
@section('content')
<form method="POST" action="{{ url('tambahpaketsoal') }}">
@csrf
<div class="container">
<div class="row">
    @if(count($errors) > 0)
    <div class="col-12">
        <div class="c-alert c-alert--warning u-mb-medium">
            <span class="c-alert__icon">
            <i class="feather icon-alert-triangle"></i>
            </span>

            <div class="c-alert__content">
            <h4 class="c-alert__title">Paket soal tidak bisa ditambah !</h4>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </div>
        </div>
    </div>
    @endif
    <div class="col-12">
        <div class="c-card u-flex u-justify-between u-flex-wrap">
            <div class="col-lg-6 u-mb-xsmall">
            <div class="c-field">
                <label class="c-field__label" for="input1">Nama Paket</label>
                <input class="c-input" type="text" name="nama" placeholder="Masukan nama paket">
            </div>
            </div>
            <div class="col-lg-6 u-mb-xsmall">
            <div class="c-field">
                <label class="c-field__label" for="input4">Section</label>
            <input class="c-input" type="text" name="section_name" value="{{ $data['section']->nama }}"  disabled>
            <input class="c-input" type="hidden" name="section_id" value="{{ $data['id'] }}">
            </div>  
            </div>
            <div class="col-lg-12 u-mb-xsmall">
            <div class="c-field">
                <label class="c-field__label" for="input2">Keterangan</label>
                <input class="c-input" type="text" name="keterangan" placeholder="Masukkan keterangan">
            </div>
            </div>
        </div>
    </div>
    <div class="col-5"></div>
    <div class="col-2">
        <br>
        <button class="c-btn c-btn--success u-mb-xsmall">Simpan</button>
    </div>
    <div class="col-5"></div>
  </div>
</div>
</form>
@endsection