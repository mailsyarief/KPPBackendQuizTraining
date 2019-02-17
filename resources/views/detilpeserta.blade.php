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
              </span>Detil Jawaban
            </a>
          </div>
          <div class="c-tabs__content tab-content" id="nav-tabContent">
            <div class="c-tabs__pane active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">


              <div class="row">
                <div class="col-xl-6">
                  <div class="c-field u-mb-medium">
                    <label class="c-field__label" for="user-name">Name</label>
                    <input class="c-input" type="text" id="user-name">
                  </div>

                  <div class="c-field u-mb-medium">
                    <label class="c-field__label" for="user-email">Email Address</label>
                    <input class="c-input" type="text" id="user-email">
                  </div>
                  <div class="c-field u-mb-medium">
                    <label class="c-field__label" for="user-phone">Phone Number</label>
                    <input class="c-input" type="tel" id="user-phone">
                  </div>
                </div>

                <div class="col-xl-6">

                  <div class="c-field u-mb-xsmall">
                    <label class="c-field__label" for="user-plan">Plan</label>
                    <div class="c-select">
                      <select class="c-select__input" id="user-plan">
                        <option>Free</option>
                        <option>Pro</option>
                        <option>Startup</option>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="c-field u-mb-medium">
                    <label class="c-field__label" for="user-zip">ZIP Code</label>
                    <input class="c-input" type="text" id="user-zip">
                  </div>

                  <div class="c-field u-mb-medium">
                    <label class="c-field__label" for="user-country">Country</label>
                    <div class="c-select">
                      <select class="c-select__input" id="user-country">
                        <option>Australia</option>
                        <option>Singapore</option>
                        <option>United Stated</option>
                        <option>United Kingdom</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <span class="c-divider u-mv-medium"></span>

              <div class="row">
                <div class="col-12 col-sm-7 col-xl-2 u-mr-auto u-mb-xsmall">
                  <button class="c-btn c-btn--info c-btn--fullwidth">Save Settings</button>
                </div>

                <div class="col-12 col-sm-5 col-xl-3 u-text-right">
                  <button class="c-btn c-btn--danger c-btn--fullwidth c-btn--outline" data-toggle="modal" data-target="#modal-delete">Delete My Account</button>

                  <div class="c-modal c-modal--small modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-delete" aria-hidden="true" style="display: none;">
                    <div class="c-modal__dialog modal-dialog" role="document">
                        <div class="c-modal__content">
                            <div class="c-modal__body">
                              <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                                  <i class="feather icon-x"></i>
                              </span>

                              <span class="c-icon c-icon--danger c-icon--large u-mb-small">
                                <i class="feather icon-alert-triangle"></i>
                              </span>
                              <h3 class="u-mb-small">Do you want to delete your account?</h3>
                              
                              <p class="u-mb-medium">By deleting you account, you no longer have access to your dashboard, members and your information.</p>

                              <div class="u-text-center">
                                <a href="#" class="c-btn c-btn--danger c-btn--outline u-mr-small" data-dismiss="modal" aria-label="Close">Cancel</a>
                                <a href="#" class="c-btn c-btn--danger">Delete</a>
                              </div>
                            </div>
                        </div><!-- // .c-modal__content -->
                    </div><!-- // .c-modal__dialog -->
                  </div><!-- // .c-modal -->
                </div>
              </div>
            </div>

            <div class="c-tabs__pane" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
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

                                {{-- <div class="col-12">
                                  <div class="c-table-responsive@wide">
                                    <table class="c-table">
                                      <thead class="c-table__head">
                                        <tr class="c-table__row">
                                          <th class="c-table__cell c-table__cell--head">Soal</th>
                                          <th class="c-table__cell c-table__cell--head">Tipe Soal</th>
                                          <th class="c-table__cell c-table__cell--head">Jawaban Peserta</th>
                                          <th class="c-table__cell c-table__cell--head">Kunci Jawaban</th>
                                          <th class="c-table__cell c-table__cell--head">Status</th>
                                        </tr>
                                      </thead>
                                    <tbody>
                                        <tr class="c-table__row">
                                          <td class="c-table__cell">
                                            <div class="o-media">
                                              <div class="o-media__body">
                                              <h6>Swing machinary PC 200-8 menggunakan tipe planetary gear 2 kali reduksi.</h6>
                                              </div>
                                            </div>
                                          </td>
                                        <td class="c-table__cell">WKWK</td>
                                        <th class="c-table__cell">WKWK</th>
                                        <th class="c-table__cell">
                                            <a class="c-badge c-badge--small c-badge--danger" href="#">Belum Ditentukan</a>
                                        </th>
                                        <th class="c-table__cell">
                                            <a class="c-badge c-badge--small c-badge--danger">SALAH</a>
                                        </th>
                                        </tr>
                                    </tbody>
                                    </table>
                                  </div>
                                </div> --}}

            </div>
          </div>
        </nav>
      </div>
    </div></div>
@endsection