<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
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
    <div class="o-page o-page--center">
      <div class="o-page__card">
        <div class="c-card c-card--center">
          <!-- <span class="c-icon c-icon--large u-mb-small"> -->
            <img src="{{url('neat/logokpp.png')}}">
          <!-- </span> -->
          <h6 class="u-mb-medium">Ujian Online</h6>
          <br>
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="c-field">
              <label class="c-field__label">Email</label>
              <input class="c-input u-mb-small" type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="c-field">
              <label class="c-field__label">Password</label>
              <input class="c-input u-mb-small" type="password" name="password" required>
            </div>
            <button class="c-btn c-btn--fullwidth c-btn--success">Login</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Main JavaScript -->
    <!-- <script src="js/neat.min.js?v=1.0"></script> -->
    <script src="{{url('neat/js/neat.min.js?v=1.0')}}"></script>
  </body>
</html>