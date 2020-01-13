@extends('layouts.base')
@section('content')
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
      <div class="row">
          <div class="col-lg-3 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="statistics statistics-horizontal">
                  <div class="info info-horizontal">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon icon-primary icon-circle">
                          <i class="now-ui-icons ui-2_chat-round"></i>
                        </div>
                      </div>
                      <div class="col-7 text-right">
                        <h3 class="info-title">{{$staked}}</h3>
                        <h6 class="stats-title">ステーカー</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="statistics statistics-horizontal">
                  <div class="info info-horizontal">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon icon-warning icon-circle">
                          <i class="now-ui-icons business_bank"></i>
                        </div>
                      </div>
                      <div class="col-7 text-right">
                        <h3 class="info-title">
                          {{$token}}<span>cc</span></h3>
                        <h6 class="stats-title">トークン</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="statistics statistics-horizontal">
                  <div class="info info-horizontal">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon icon-danger icon-circle">
                          <i class="now-ui-icons sport_user-run"></i>
                        </div>
                      </div>
                      <div class="col-7 text-right">
                        <h3 class="info-title">{{$stakes}}</h3>
                        <h6 class="stats-title">ステーク数</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="statistics statistics-horizontal">
                  <div class="info info-horizontal">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon icon-info icon-circle">
                          <i class="now-ui-icons ui-2_favourite-28"></i>
                        </div>
                      </div>
                      <div class="col-7 text-right">
                        <h3 class="info-title">{{$followed}}</h3>
                        <h6 class="stats-title">フォロワー</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                @if($user->main_img==null)
                  <img src="img/image_placeholder.jpg" alt="...">
                @else
                  <img src="upload/main/{{$user->main_img}}" alt="...">
                @endif
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    @if($user->profile_img==null)
                      <img class="avatar border-gray" src="img/placeholder.jpg" alt="...">
                    @else
                      <img class="avatar border-gray" src="upload/profile/{{$user->profile_img}}" alt="...">
                    @endif
                    <h5 class="title">{{$user->last_name}} {{$user->first_name}}</h5>
                  </a>
                  <p class="description">
                  {{$user->name}}
                  </p>
                </div>
                <p class="description text-center">
                {{$user->free_comment}}
                </p>
              </div>
              <hr>
              <div class="button-container">
                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-facebook-f"></i>
                </button>
                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-twitter"></i>
                </button>
                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="now-ui-icons media-1_camera-compact"></i>
                </button>
              </div>
              <div class="text-center">
              <button id="send_token" class="btn btn-primary btn-round" style="margin:0px 0px 20px 0px">
                  <i class="now-ui-icons ui-1_send"></i>  トークンを送る
              </button>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">プロフィール</h5>
                <a href="./user_edit?uid={{$user->id}}"><small>プロフィールを編集する</small></a>
              </div>
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>メールアドレス</label>
                        <input type="text" class="form-control" disabled="" placeholder="aaa@bbb.jp" value="{{Auth::user()->email}}">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>ユーザー名</label>
                        <input type="text" class="form-control" disabled="" placeholder="ニックネームをつけてください" value="{{$user->name}}">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">誕生日</label>
                        <input type="date" class="form-control" disabled="" placeholder="{{$user->birthday}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>姓</label>
                        <input type="text" class="form-control" disabled="" placeholder="姓" value="{{$user->last_name}}">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>名</label>
                        <input type="text" class="form-control" disabled="" placeholder="名" value="{{$user->first_name}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>キャッチコピー</label>
                        <input type="text" class="form-control" disabled="" placeholder="あたなを一言で表すと？" value="{{$user->catchcopy}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>所属</label>
                        <input type="text" class="form-control" disabled="" placeholder="学校や会社を教えてください" value="{{$user->work_company}}">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>役職</label>
                        <input type="text" class="form-control" disabled="" placeholder="あなたの立場は？（盛らないように！）" value="{{$user->work_position}}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>スキル</label>
                        <input type="text" class="form-control" disabled="" placeholder="City" value="{{$user->skill_set}}">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>挑戦しているスキル</label>
                        <input type="text" class="form-control" disabled="" placeholder="スキル" value="{{$user->challenge_skill}}">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Webサイト</label>
                        <input type="text" class="form-control" disabled="" placeholder="{{$user->website}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>コメント</label>
                        <textarea rows="4" cols="80" class="form-control" disabled="" placeholder="自由にご記入ください！" value="Mike">{{$user->free_comment}}</textarea>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  <meta name="token" content="{{ csrf_token() }}">
  <script>
    //モーダル表示
    $('#send_token').on('click',function(){
      Swal.fire({
        title: '送付するトークン量を入力してください',
        html: '<div class="form-group">' +
          '<input id="token-input-field" type="text" class="form-control" />' +
          '</div>',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
      }).then(function(result) {
        let token = $('#token-input-field').val();
        $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                type:'POST', 
                url:'./send_token',
                data: {'sender_id': {{Auth::user()->id}},'accepter_id': {{$user->id}},'price':token}
            }).done(function (res){
              Swal.fire({
                title: "{{Auth::user()->name}}さんにトークンを送りました!",
                text: token+"ccが無事、送金されました！",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
              });
            }).fail(function(){
              alert('ファイルの取得に失敗しました');
            });
        });
      });
  </script>
@endsection