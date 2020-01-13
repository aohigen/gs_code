@extends('layouts.base')
@section('content')
<div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <form id="TypeValidation" class="form-horizontal" action="{{ url('new_project') }}" method="POST">
            {{ csrf_field() }}
            <input name="created_user_id" type="hidden" value={{Auth::user()->id}}>
              <div class="card ">
                <div class="card-header ">
                  <h4 class="card-title">新しいプロジェクト</h4>
                </div>
                <div class="card-body ">
                  <div class="row">
                    <label class="col-sm-2 col-form-label">プロジェクト名</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <input class="form-control" type="text" name="project_name" required="true" />
                      </div>
                    </div>
                    <label class="col-sm-3 label-on-right">
                      <code>必須</code>
                    </label>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">プロジェクトの内容</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="project_detail">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-md-3 col-form-label">目標</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="project_goal">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">意気込み</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="before_comment">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">期限</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="date" class="form-control" name="limit_date">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">タグ</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="tags">
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

