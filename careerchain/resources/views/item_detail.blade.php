@extends('layouts.base')
@section('content')
<div class="panel-header panel-header-sm">
  </div>
      <div class="content">
      <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-lg-12">
                <div class="card card-pricing ">
                  <h4>{{$item->item_name}}</h4>
                  <div class="card-body">
                    <div class="card-icon icon-primary ">
                      <i class="now-ui-icons objects_diamond"></i>
                    </div>
                    <h3 class="card-title">{{$item->price}}<small>ccc</small></h3>
                    <ul>
                      <li>{{$item->item_copy}}</li>
                      <li>{{$item->item_detail}}</li>
                    </ul>
                  </div>
                  <div class="card-footer">
                    <button class="btn btn-round btn-primary" id="item_purchase">申し込む</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 text-center">
            <div class="card card-contributions">
              <div class="card-body ">
                <h1 class="card-title">21</h1>
                <h3 class="card-category">このアイテムを購入した人数</h3>
                <p class="card-description">購入の際の参考にしてください。</p>
              </div>
            </div>
          </div>
        </div>
      </div>
  <meta name="token" content="{{ csrf_token() }}">
  <script>
    //申し込みのajax
    $(function(){
        $('#item_purchase').click(function(){
            $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                type:'POST', 
                url:'./market_contract',
                data: {'user_id': {{Auth::user()->id}},'owner_id': {{$item->user_id}},'item_id':{{$item->id}},'price':{{$item->price}} }
            }).done(function (res){
              alert(res);
              Swal.fire({
                title: "申し込みました!",
                text: "{{$item->price}}ccが無事、送金されました！",
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