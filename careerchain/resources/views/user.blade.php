@extends('layouts.base')
@section('content')
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">プロフィール</h5>
              </div>
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>メールアドレス</label>
                        <input type="text" class="form-control" disabled="" placeholder="Company" value="{{Auth::user()->email}}">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>ユーザー名</label>
                        <input type="text" class="form-control" placeholder="Username" value="{{$user->nick_name}}">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">誕生日</label>
                        <input type="email" class="form-control" placeholder="{{$user->birthday}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>姓</label>
                        <input type="text" class="form-control" placeholder="Company" value="{{$user->last_name}}">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>名</label>
                        <input type="text" class="form-control" placeholder="Last Name" value="{{$user->first_name}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>キャッチコピー</label>
                        <input type="text" class="form-control" placeholder="Home Address" value="{{$user->catchcopy}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>所属</label>
                        <input type="text" class="form-control" placeholder="Company" value="{{$user->work_company}}">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>名</label>
                        <input type="text" class="form-control" placeholder="Last Name" value="{{$user->work_position}}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>スキル</label>
                        <input type="text" class="form-control" placeholder="City" value="{{$user->skill_set}}">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>挑戦しているスキル</label>
                        <input type="text" class="form-control" placeholder="Country" value="{{$user->challenge_skill}}">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Webサイト</label>
                        <input type="number" class="form-control" placeholder="{{$user->website}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>コメント</label>
                        <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description" value="Mike">{{$user->free_comment}}</textarea>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="upload/main/{{$user->main_img}}" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="upload/profile/{{$user->profile_img}}" alt="...">
                    <h5 class="title">{{$user->last_name}} {{$user->first_name}}</h5>
                  </a>
                  <p class="description">
                  {{$user->nick_name}}
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
                  <i class="fab fa-google-plus-g"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection