@extends('layout')
@section('content')
<div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="c-state-card c-state-card--info">
                <h4 class="c-state-card__title">Peserta</h4>
                <span class="c-state-card__number">45</span>

                <div class="c-state-card__actions dropdown"> 
                  <span class="dropdown-toggle" id="dropdownMenuState1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                    <i class="feather icon-more-vertical"></i>
                  </span>

                  <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuState1">
                    <a class="c-dropdown__item dropdown-item" href="#">Link 1</a>
                    <a class="c-dropdown__item dropdown-item" href="#">Link 2</a>
                    <a class="c-dropdown__item dropdown-item" href="#">Link 3</a>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="col-md-4">
              <div class="c-state-card c-state-card--success">
                <h4 class="c-state-card__title">Section</h4>
              <span class="c-state-card__number">{{ $data['section'] }}</span>
                <div class="c-state-card__actions dropdown"> 
                  <span class="dropdown-toggle" id="dropdownMenuState2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                    <i class="feather icon-more-vertical"></i>
                  </span>

                  <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuState2">
                    <a class="c-dropdown__item dropdown-item" href="#">Link 1</a>
                    <a class="c-dropdown__item dropdown-item" href="#">Link 2</a>
                    <a class="c-dropdown__item dropdown-item" href="#">Link 3</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="c-state-card c-state-card--fancy">
                <h4 class="c-state-card__title">Peserta lulus kkm</h4>
                <span class="c-state-card__number">10</span>
                <div class="c-state-card__actions dropdown"> 
                  <span class="dropdown-toggle" id="dropdownMenuState3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                    <i class="feather icon-more-vertical"></i>
                  </span>

                  <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuState3">
                    <a class="c-dropdown__item dropdown-item" href="#">Link 1</a>
                    <a class="c-dropdown__item dropdown-item" href="#">Link 2</a>
                    <a class="c-dropdown__item dropdown-item" href="#">Link 3</a>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
</div>
@endsection