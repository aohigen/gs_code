@extends('layouts.base')
@section('content')
<div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <form id="TypeValidation" enctype="multipart/form-data" class="form-horizontal" action="{{ url('market_resist') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" value="{{Auth::user()->id}}" name="user_id" required="true" />
              <div class="card ">
                <div class="card-header ">
                  <h4 class="card-title">{{Auth::user()->name}}さんのプロダクト</h4>
                </div>
                <div class="card-body ">
                  <div class="row">
                    <label class="col-sm-2 col-form-label">アイテム名</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <input class="form-control" type="text" value="" name="item_name" required="true" />
                      </div>
                    </div>
                    <label class="col-sm-3 label-on-right">
                      <code>必須</code>
                    </label>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">アイテムタイプ</label>
                    <div class="col-sm-10 checkbox-radios">
                      <div class="form-check form-check-radio">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="item_type" id="exampleRadios1" value="message" checked>
                          <span class="form-check-sign"></span>
                          メッセージ
                        </label>
                      </div>
                      <div class="form-check form-check-radio">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="item_type" id="exampleRadios2" value="meeting">
                          <span class="form-check-sign"></span>
                          面談
                        </label>
                      </div>
                      <div class="form-check form-check-radio">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="item_type" id="exampleRadios2" value="menter">
                          <span class="form-check-sign"></span>
                          メンター
                        </label>
                      </div>
                      <div class="form-check form-check-radio">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="item_type" id="exampleRadios2" value="transfer">
                          <span class="form-check-sign"></span>
                          移籍
                        </label>
                      </div>
                      <div class="form-check form-check-radio">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="item_type" id="exampleRadios2" value="timeshare">
                          <span class="form-check-sign"></span>
                          タイムシェア
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">料金</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <input class="form-control" type="number" name="price" required="true" />
                      </div>
                    </div>
                    <label class="col-sm-3 label-on-right">
                    </label>
                  </div>
                  <div class="row">
                    <label class="col-md-3 col-form-label">キャッチコピー</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="text" class="form-control" name="item_copy">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">アイテムの詳細</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                      <textarea class="form-control" placeholder="アイテムの詳細を記入してください" name="item_detail"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">販売対象</label>
                    <div class="col-sm-10 checkbox-radios">
                      <div class="form-check form-check-radio">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="sell_scope" id="exampleRadios1" value="all" checked>
                          <span class="form-check-sign"></span>
                          すべてのユーザー
                        </label>
                      </div>
                      <div class="form-check form-check-radio">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="sell_scope" id="exampleRadios2" value="staker">
                          <span class="form-check-sign"></span>
                          ステーカー
                        </label>
                      </div>
                      <div class="form-check form-check-radio">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="sell_scope" id="exampleRadios2" value="follower">
                          <span class="form-check-sign"></span>
                          フォロワー
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">マーケットに公開する</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      
@endsection

