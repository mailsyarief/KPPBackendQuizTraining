
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $data['title'] }}</title>
    <meta name="description" content="Neat">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{url('neat/css/neat.min.css?v=1.0')}}">
  </head>
  <body>

    <div class="o-page">
      <div class="o-page__sidebar js-page-sidebar">
        <aside class="c-sidebar">
          <div class="c-sidebar__brand">
            <a href="#"><img src="{{url('neat/logokpp.png')}}"></a>
          </div>

          <!-- Scrollable -->
          <div class="c-sidebar__body">
            <span class="c-sidebar__title">TRAINING QUIZ</span>
            <ul class="c-sidebar__list">
              <li>
                <a class="c-sidebar__link" href="{{url('/home')}}">
                  <i class="c-sidebar__icon feather icon-home"></i>Home
                </a>
              </li>
              <li>
                <a class="c-sidebar__link" href="{{url('/peserta')}}">
                  <i class="c-sidebar__icon feather icon-user"></i>Peserta
                </a>
              </li>
              <li>
              <a class="c-sidebar__link" href="{{ url('/section') }}">
                  <i class="c-sidebar__icon feather icon-tag"></i>Section
                </a>
              </li>
              <li>
                <a class="c-sidebar__link" href="invoice.html">
                  <i class="c-sidebar__icon feather icon-file-text"></i>Soal
                </a>
              </li>
              <li>
                <a class="c-sidebar__link" href="https://zawiastudio.com/neat/docs/">
                  <i class="c-sidebar__icon feather icon-book"></i>Charts
                </a>
              </li>
            </ul>
          </div>
          
          <form method="POST" action="{{url('/logout')}}">
            @csrf
            <button type="submit" class="c-sidebar__footer" href="#">
              Logout <i class="c-sidebar__footer-icon feather icon-power"></i>
            </button>
          </form>
        </aside>
      </div>

      <main class="o-page__content">
        <header class="c-navbar u-mb-medium">
          <button class="c-sidebar-toggle js-sidebar-toggle">
            <i class="feather icon-align-left"></i>
          </button>
          <h2 class="c-navbar__title">{{ $data['title'] }}</h2>
        </header>
        @yield('content')
      </main>
    </div>

    <!-- Main JavaScript -->
    <script src="{{url('neat/js/neat.min.js?v=1.0')}}"></script>
  </body>
</html>