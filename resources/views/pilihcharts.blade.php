@extends('layout')
@section('content')
<div class="container">
    <div class="row u-pv-large">
      <div class="col-lg-5 u-text-center u-ml-auto u-mr-auto">
        @if($data['section']->count() != 0)<h1>Pilih Charts</h1>
        @else<h1>Belum ada section yang terdaftar</h1>
        @endif
      </div>
    </div>
    <div class="row u-mb-xlarge">
    @if($data['section']->count() != 0)
        @foreach($data['section'] as $section)
        <div class="col-lg-4">
            <div class="c-plan" align="center">

            <h3 class="c-plan__title">{{ $section->nama }}</h3>
            <br>
            <a class="c-btn c-btn--info c-btn--outline c-btn--fullwidth" href="{{ url('/lihatcharts/'.$section->id) }}">Lihat Chart</a>
            </div>
        </div>
        @endforeach
      @endif
    </div>
</div>
@endsection
