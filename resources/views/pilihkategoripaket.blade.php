@extends('layout')
@section('content')
<div class="container">
    {{-- <div class="row u-pv-large">
      <div class="col-lg-5 u-text-center u-ml-auto u-mr-auto">
      </div>
    </div>  --}}
    <div class="row u-mb-xlarge">
        <div class="col-lg-4">
            <div class="c-plan" align="center">
            <h3 class="c-plan__title">Belum Ujian</h3>
            <br>
            <a class="c-btn c-btn--info c-btn--outline c-btn--fullwidth" href="{{ url('/peserta/belumujian') }}">Lihat Peserta</a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="c-plan" align="center">
            <h3 class="c-plan__title">Sedang Ujian</h3>
            <br>
            <a class="c-btn c-btn--info c-btn--outline c-btn--fullwidth" href="{{ url('/peserta/sedangujian') }}">Lihat Peserta</a>
            </div>
        </div>
        <div class="col-lg-4">
                <div class="c-plan" align="center">
                <h3 class="c-plan__title">Selesai Ujian</h3>
                <br>
                <a class="c-btn c-btn--info c-btn--outline c-btn--fullwidth" href="{{ url('/peserta/selesaiujian') }}">Lihat Peserta</a>
                </div>
            </div>
    </div>
</div>
@endsection
