@extends('layouts.base')
@section('content')
<div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">マーケット</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-shopping">
                    <thead class="">
                      <th class="text-center">
                      </th>
                      <th>
                        アイテム名
                      </th>
                      <th>
                        タイプ
                      </th>
                      <th class="text-right">
                        価格
                      </th>
                      <th class="text-right">
                        公開日
                      </th>
                    </thead>
                    <tbody>
                    @foreach ($markets as $market)
                      <tr style="height:100px">
                        <td style="width:100px">
                          <div class="img-container">
                            @if(DB::table('users')->where('id',$market->user_id)->value('profile_img')==null)
                            <img src="img/placeholder.jpg">
                            @else
                            <img src="upload/profile/{{DB::table('users')->where('id',$market->user_id)->value('profile_img')}}">
                            @endif
                          </div>
                        </td>
                        <td class="td-name">
                          <a href="./item_detail?item_id={{$market->id}}">{{$market->item_name}}</a>
                          <br />
                          <small>by {{$market->user_name}}</small>
                        </td>
                        <td>
                        {{$market->item_type}}
                        </td>
                        <td class="td-number">
                          {{$market->price}}<small>cc</small>
                        </td>
                        <td>
                        {{$market->created_at}}
                        </td>
                        <td class="td-actions">
                          <button type="button" rel="tooltip" data-placement="left" title="Remove item" class="btn btn-neutral">
                            <i class="now-ui-icons ui-1_simple-remove"></i>
                          </button>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection


