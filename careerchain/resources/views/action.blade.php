@extends('layouts.base')
@section('content')
<div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="card ">
              <div class="card-header ">
                <h4 class="card-title">トークンアカウントを作る</h4>
              </div>
              {{ csrf_field() }}
              <input type="hidden" value="{{Auth::user()->id}}" name="user_id" required="true" />
                <div class="card-body">
                  <label>Tokenパスワード</label>
                  <div class="form-group">
                    <input type="text" class="form-control" name="password">
                  </div>
                  <label>パスワード（確認）</label>
                  <div class="form-group">
                    <input type="text" class="form-control" name="password2">
                  </div>
                </div>
              <div class="card-footer ">
                <button type="submit" class="btn btn-fill btn-primary" id="make_account">申請する</button>
              </div>
              <div id="token_address"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card ">
              <div class="card-header ">
                <h4 class="card-title">送金する</h4>
              </div>
              <form method="post" action="/send_token" class="form-horizontal">
                {{ csrf_field() }}
                <div class="card-body ">
                  <div class="row">
                    <label class="col-md-3 col-form-label">誰に送る？</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="to_who">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">いくら？</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="email" class="form-control" name="price">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">パスワード</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="password" class="form-control" name="send_pw">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer ">
                  <div class="row">
                    <label class="col-md-3"></label>
                    <div class="col-md-9">
                      <button type="submit" class="btn btn-fill btn-primary">トークンを送る</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <h4 class="card-title">ブロックチェーンに刻む</h4>
              </div>
              <div class="card-body ">
                <form method="post" action="/write_blockchain" class="form-horizontal">
                {{ csrf_field() }}
                  <div class="row">
                    <label class="col-sm-2 col-form-label">タイトル</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="text" class="form-control" name="title">
                        <span class="form-text">ブロックチェーンに刻みたいことの要約を記載ください</span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">カテゴリ</label>
                    <div class="col-sm-10 checkbox-radios">
                      <div class="form-check form-check-radio">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="ct_work" id="exampleRadios1" value="option1" checked>
                          <span class="form-check-sign"></span>
                          ワーク
                        </label>
                      </div>
                      <div class="form-check form-check-radio">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="ct_memo" id="exampleRadios2" value="option2">
                          <span class="form-check-sign"></span>
                          メモ
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">内容</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <textarea class="form-control" placeholder="書き込みたい内容を入力してください" name="article"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">パスワード</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="password" class="form-control" name="write_pw">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-10">
                      <div class="form-group">
                      　<button type="submit" class="btn btn-fill btn-primary">書き込む</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <h4 class="card-title">テスト用</h4>
              </div>
              <div class="card-body ">
                {{ csrf_field() }}
                  <div class="row">
                    <div class="col-sm-10">
                      <div class="form-group">
                      　<button type="submit" class="btn btn-fill btn-primary" id="get_accounts">アカウントを取得</button>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  <meta name="token" content="{{ csrf_token() }}">
  <script>
    //新規アカウントの作成
    $(function(){
        $('#make_account').click(function(){
            $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                type:'POST', 
                url:'./make_account',
                dataType:'text',
                data: {'user_id': {{Auth::user()->id}} }
            }).done(function (res){
              alert('成功しました：'+res);
            }).fail(function(){
              alert('ファイルの取得に失敗しました');
            });
        });
    });
    //テスト用：アカウント一覧を取得
    $(function(){
        $('#get_accounts').click(function(){
            $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                type:'POST', 
                url:'./get_accounts',
                data: {'user_id': {{Auth::user()->id}} }
            }).done(function (res){
              alert('成功しました：'+res);
            }).fail(function(){
              alert('ファイルの取得に失敗しました');
            });
        });
    });
  </script>
@endsection


