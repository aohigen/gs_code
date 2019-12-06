@extends('layouts.base')
@section('content')
<div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <form id="TypeValidation" enctype="multipart/form-data" class="form-horizontal" action="{{ url('profile_resist') }}" method="POST">
            {{ csrf_field() }}
            <input name="user_id" type="hidden" value={{Auth::user()->id}}>
              <div class="card ">
                <div class="card-header ">
                  <h4 class="card-title">{{Auth::user()->name}}さんのプロフィール</h4>
                </div>
                <div class="card-body ">
                  <div class="row">
                    <label class="col-sm-2 col-form-label">ユーザー名</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <input class="form-control" type="text" value="{{Auth::user()->name}}" name="nick_name" required="true" />
                      </div>
                    </div>
                    <label class="col-sm-3 label-on-right">
                      <code>必須</code>
                    </label>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">姓（実名）</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <input class="form-control" type="text" name="last_name" required="true" />
                      </div>
                    </div>
                    <label class="col-sm-3 label-on-right">
                    </label>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">名（実名）</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <input class="form-control" type="text" name="first_name" required="true" />
                      </div>
                    </div>
                    <label class="col-sm-3 label-on-right">
                    </label>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">キャッチコピー</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="catchcopy">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-md-3 col-form-label">生年月日</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="date" class="form-control datepicker" value="10/05/2016" name="birthday">
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">ウェブサイト</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="url" class="form-control datepicker" name="website">
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                        <h4 class="card-title">プロフィール画像</h4>
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                          <div class="fileinput-new thumbnail img-circle">
                            <img src="img/placeholder.jpg" alt="...">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                          <div>
                            <span class="btn btn-round btn-rose btn-file">
                              <span class="fileinput-new">写真を選択</span>
                              <span class="fileinput-exists">変更</span>
                              <input type="file" name="profile_img" />
                            </span>
                            <br />
                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6">  
                    <h4 class="card-title">背景画像</h4>
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                          <div class="fileinput-new thumbnail">
                            <img src="img/image_placeholder.jpg" alt="...">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail"></div>
                          <div>
                            <span class="btn btn-rose btn-round btn-file">
                              <span class="fileinput-new">写真を選択</span>
                              <span class="fileinput-exists">変更</span>
                              <input type="file" name="main_img" />
                            </span>
                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> 削除</a>
                          </div>
                        </div>
                      </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">出身地</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="birth_prefecture">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">国籍</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="nationality">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">勤務先</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="work_company">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">業界</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="work_industry">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">ポジション（役職）</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="work_position">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">卒業</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="final_education">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">スキルセット</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="skill_set">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">挑戦しているスキル</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="challenge_skill">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">フリーコメント</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="free_comment">
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
      
@endsection

