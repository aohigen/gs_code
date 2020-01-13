@extends('layouts.front')

@section('content')

  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-5 ml-auto">
          <div class="info-area info-horizontal mt-5">
            <div class="icon icon-primary">
              <i class="now-ui-icons media-2_sound-wave"></i>
            </div>
            <div class="description">
              <h5 class="info-title">刻もう</h5>
              <p class="description">
                ブロックチェーンにあなたのキャリアを刻み、あなたの頑張りを地球が崩壊するまで残そう
              </p>
            </div>
          </div>
          <div class="info-area info-horizontal">
            <div class="icon icon-primary">
              <i class="now-ui-icons media-1_button-pause"></i>
            </div>
            <div class="description">
              <h5 class="info-title">応援しよう</h5>
              <p class="description">
                あなたが誰かを応援することで、誰かが頑張れます。
              </p>
            </div>
          </div>
          <div class="info-area info-horizontal">
            <div class="icon icon-info">
              <i class="now-ui-icons users_single-02"></i>
            </div>
            <div class="description">
              <h5 class="info-title">育てよう</h5>
              <p class="description">
                誰かのステークホルダーとなることで、将来その人がCareerChainを通じて得た利益の配分を得ることができます
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mr-auto">
          <div class="card card-signup text-center">
            <div class="card-header ">
              <h4 class="card-title">新規登録</h4>
              <!-- <div class="social">
                <button class="btn btn-icon btn-round btn-twitter">
                  <i class="fab fa-twitter"></i>
                </button>
                <button class="btn btn-icon btn-round btn-dribbble">
                  <i class="fab fa-dribbble"></i>
                </button>
                <button class="btn btn-icon btn-round btn-facebook">
                  <i class="fab fa-facebook-f"></i>
                </button>
                <h5 class="card-description"> or be classical </h5>
              </div>
            </div> -->
            <div class="card-body ">
              <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="input-group form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="now-ui-icons users_circle-08"></i>
                    </div>
                  </div>
                    <input id="name" type="text" class="form-control" placeholder="ユーザーID" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif
                </div>
                <div class="input-group form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="now-ui-icons ui-1_email-85"></i>
                    </div>
                  </div>
                    <input type="text" for="email" class="form-control" placeholder="Email..." name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                </div>
                <div class="input-group form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="now-ui-icons text_caps-small"></i>
                    </div>
                  </div>
                    <input id="email" type="password" placeholder="パスワード" class="form-control" name="password" required>
                    @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="now-ui-icons text_caps-small"></i>
                    </div>
                  </div>
                    <input id="password-confirm" type="password" placeholder="パスワード（確認用）" class="form-control" name="password_confirmation" required>
                </div>

                <div class="form-check text-left">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
                    <span class="form-check-sign"></span>
                    <a href="#something">利用規約</a>に同意して申し込みます。
                  </label>
                </div>
              
            </div>
            <div class="card-footer ">
              <button type="submit" class="btn btn-primary">
                  登録する
              </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection