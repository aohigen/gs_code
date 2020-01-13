@extends('layouts.front')

@section('content')

  <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
  <div class="content">
    <div class="container">
      <div class="col-md-4 ml-auto mr-auto">
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="card card-login card-plain">
            <div class="card-header ">
              <div class="logo-container">
                <img src="img/now-logo.png" alt="">
              </div>
            </div>
            <div class="card-body ">
              <div class="input-group no-border form-control-lg form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <span class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="now-ui-icons users_circle-08"></i>
                  </div>
                </span>
                  <input id="email" type="email" class="form-control" placeholder="ユーザーID" name="email" value="{{ old('email') }}" required autofocus>
                  @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
              </div>
              <div class="input-group no-border form-control-lg form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="now-ui-icons text_caps-small"></i>
                  </div>
                </div>
                  <input id="password" type="password" placeholder="パスワード" class="form-control" name="password">
                  @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
            </div>
            <div class="card-footer ">
              <div class="pull-left">
              <button type="submit" class="btn btn-primary">
                  ログイン
              </button>
                <h6>
                  <a href="{{ route('register') }}" class="link footer-link">新規登録</a>
                </h6>
              </div>
              <div class="pull-right">
                <h6>
                  <a href="{{ route('password.request') }} class="link footer-link">パスワードを忘れた方</a>
                </h6>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endsection