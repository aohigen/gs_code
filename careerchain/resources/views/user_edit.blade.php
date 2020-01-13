@extends('layouts.base')
@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <form id="TypeValidation" enctype="multipart/form-data" class="form-horizontal" action="{{ url('user_edit') }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" value="{{Auth::user()->id}}" name="id" required="true" />
        <div class="card">
          <div class="card-header ">
            <h4 class="card-title">{{Auth::user()->name}}さんのプロフィール</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-5 px-1">
                <label>ユーザーID</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <input type="text" class="form-control" disabled="" placeholder="ニックネームをつけてください" name="name" value="{{$user->name}}">
                  </div>
                </div>
              </div>
              <div class="col-md-5 pr-1">
                <div class="form-group">
                  <label>メールアドレス</label>
                  <input type="text" class="form-control" disabled="" placeholder="sample@careerchain.jp" name="email" value="{{Auth::user()->email}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>姓</label>
                  <input type="text" class="form-control" placeholder="苗字を入力してください" name="last_name" value="{{$user->last_name}}">
                </div>
              </div>
              <div class="col-md-6 pl-1">
                <div class="form-group">
                  <label>名</label>
                  <input type="text" class="form-control" placeholder="名前を入力してください" name="first_name" value="{{$user->first_name}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                <div class="fileinput-new thumbnail img-circle">
                  @if($user->profile_img==null)
                    <img src="img/image_placeholder.jpg" alt="...">
                  @else
                    <img src="upload/profile/{{$user->profile_img}}" alt="...">
                  @endif
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                  <div>
                    <span class="btn btn-round btn-rose btn-file">
                      <span class="fileinput-new">プロフィール写真を選択</span>
                      <span class="fileinput-exists">変更</span>
                      <input type="file" name="profile_img" />
                    </span>
                    <br />
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> 削除</a>
                  </div>
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                  <div class="fileinput-new thumbnail">
                    @if($user->profile_img==null)
                      <img src="img/image_placeholder.jpg">
                    @else
                      <img src="upload/main/{{$user->main_img}}">
                    @endif
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail"></div>
                  <div>
                    <span class="btn btn-rose btn-round btn-file">
                      <span class="fileinput-new">背景写真を選択</span>
                      <span class="fileinput-exists">変更</span>
                      <input type="file" name="main_img" />
                    </span>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> 削除</a>
                  </div>
                </div>
              </div> 
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>キャッチコピー</label>
                  <input type="text" class="form-control" placeholder="あたなを一言で表すと？" name="catchcopy" value="{{$user->catchcopy}}">
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>生年月日</label>
                  <input type="date" class="form-control" placeholder="誕生日を入力してください" name="birthday" placeholder="{{$user->birthday}}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>出身地</label>
                  <input type="text" class="form-control" placeholder="出身地を入力してください" name="birth_prefecture" placeholder="{{$user->birth_prefecture}}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>国籍</label>
                  <input type="text" class="form-control" placeholder="国籍を入力してください" name="nationality" placeholder="{{$user->nationality}}">
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>ウェブサイト</label>
                  <input type="url" class="form-control" placeholder="あなたのウェブサイトがあればアピールしましょう！" name="website" value="{{$user->website}}">
                </div>
              </div>
            </div>
            <br><br>
            <h5 class="title">トークンアドレス</h5>
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>アドレス</label>
                  @if($user->token_address==null)
                    <input type="text" id="token_address" class="form-control" disabled="" placeholder="下のボタンをクリックしてアドレスを取得してください" name="token_address" value="">
                    <a class="btn btn-fill btn-info" id="make_account" style="color:white">トークンを申請する（300ccプレゼント！）</a>
                  @else
                    <input type="text" class="form-control" disabled="" name="token_address" value="{{$user->token_address}}">
                  @endif
                </div>
              </div>
            </div>
            <br><br>
            <h5 class="title">キャリアについて</h5>
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>所属</label>
                  <input type="text" class="form-control" placeholder="学校や会社を教えてください" name="work_company" value="{{$user->work_company}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 pl-1">
                <div class="form-group">
                  <label>業界</label>
                  <input type="text" class="form-control" placeholder="あなたの業界を教えてください" name="work_industry" value="{{$user->work_industry}}">
                </div>
              </div>
              <div class="col-md-6 pl-1">
                <div class="form-group">
                  <label>役職</label>
                  <input type="text" class="form-control" placeholder="あなたの立場は？（盛らないでね！）" name="work_position" value="{{$user->work_position}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>スキル</label>
                  <input type="text" class="form-control" placeholder="あなた持っているスキルを教えてください" name="skill_set" value="{{$user->skill_set}}">
                </div>
              </div>
              <div class="col-md-4 px-1">
                <div class="form-group">
                  <label>挑戦しているスキル</label>
                  <input type="text" class="form-control" placeholder="現在チャレンジしているスキルがあれば教えてください" name="challenge_skill" value="{{$user->challenge_skill}}">
                </div>
              </div>
              <div class="col-md-4 px-1">
                <div class="form-group">
                  <label>最終学歴</label>
                  <input type="text" class="form-control" placeholder="最終学歴を教えてください" name="final_education" value="{{$user->final_education}}">
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>コメント</label>
                  <textarea rows="40" cols="80" class="form-control" placeholder="自由にご記入ください！" name="free_comment"  value="{{$user->free_comment}}">{{$user->free_comment}}</textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">登録する</button>
          </div>
        </div>
      </form>
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
            Swal.fire({
                title: "アドレスが作成されました！",
                text: "新規登録の特典として、300ccが付与されています！あなたのアドレス【"+res+"】",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
              });
            $('#token_address').val(res);
          }).fail(function(){
            alert('ファイルの取得に失敗しました');
          });
      });
  });
</script>

@endsection