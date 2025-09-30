@extends('layouts.auth')

@section('content')

<section class="crancy-wc crancy-wc__full crancy-bg-cover">
        <div class="crancy-wc__form">
          <div class="crancy-wc__form--middle">
            <div class="crancy-wc__form-inner">
              <div class="crancy-wc__logo">
                <a href="{{ route('home') }}"><img src="{{ url('public/assets/'.$settings['site_logo']) }}" alt="#" /></a>
              </div>
              <div class="crancy-wc__form-inside">
                <div class="crancy-wc__form-middle">
                  <div class="crancy-wc__form-top">
                    <div class="crancy-wc__heading pd-btm-20">
                      <h3
                        class="crancy-wc__form-title crancy-wc__form-title__one m-0">
                        Login to Admin Panel
                      </h3>
                    </div>
                    <form class="crancy-wc__form-main" action="{{ route('login') }}" method="post">
                      @csrf
                      <div class="form-group">
                        <div class="form-group__input">
                          <input class="crancy-wc__form-input" type="email" name="email" placeholder="Email" required="required"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-group__input">
                          <input class="crancy-wc__form-input" placeholder="Password" id="password-field" type="password" name="password" maxlength="8" required="required"/>
                          <span class="crancy-wc__toggle" ><i class="fas fa-eye" id="toggle-icon"></i></span>
                        </div>
                      </div>
                      <div class="form-group mg-top-30">
                        <div class="crancy-wc__button">
                          <button class="ntfmax-wc__btn" type="submit">
                            Sign in
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="crancy-wc__footer--top">
                    <p class="crancy-wc__footer--copyright">
                      @ {{ date('Y') }} <a href="#">{{ $settings['site_title'] }}.</a> All Right Reserved.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="crancy-wc__banner crancy-bg-cover"
              style="background-image: url('{{ url('public/admin-assets/img/welcome-vector-shape.png') }}')"
            >
              <div class="crancy-wc__banner--img">
                <img src="{{ url('public/admin-assets/img/welcome-vector.png') }}" alt="#" />
              </div>
              <div class="crancy-wc__slider">
                <!-- Sinlge Slider -->
                <div class="single-slider">
                  <div class="crancy-wc__slider--single">
                    <div class="crancy-wc__slider--content">
                      <h4 class="crancy-wc__slider--title">
                        The Easiest Way to Build <br />
                        your Own Business
                      </h4>
                      <p class="crancy-wc__slider--text">
                        Curates the best new blockchain jobs at leading
                        companies that use blockchain technology
                      </p>
                    </div>
                  </div>
                </div>
                <!-- Sinlge Slider -->
                <div class="single-slider">
                  <div class="crancy-wc__slider--single">
                    <div class="crancy-wc__slider--content">
                      <h4 class="crancy-wc__slider--title">
                        Sign in & Get the Access to Manage Apps
                      </h4>
                      <p class="crancy-wc__slider--text">
                        Curates the best new blockchain jobs at leading
                        companies that use blockchain technology
                      </p>
                    </div>
                  </div>
                </div>
                <!-- Sinlge Slider -->
                <div class="single-slider">
                  <div class="crancy-wc__slider--single">
                    <div class="crancy-wc__slider--content">
                      <h4 class="crancy-wc__slider--title">
                        The Easiest Way to Build <br />
                        your Own Business
                      </h4>
                      <p class="crancy-wc__slider--text">
                        Curates the best new blockchain jobs at leading
                        companies that use blockchain technology
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection