
@extends('layouts.base')
@section('content')
<div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">{{$project->project_name}}</h4>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-sm-8">
                    <div class="card card-testimonial">
                      <div class="card-header card-header-avatar">
                        <a href="#pablo">
                          <img class="img img-raised" src="upload/profile/{{$user->profile_img}}">
                        </a>
                      </div>
                      <div class="card-body ">
                        <p class="card-description">
                        {{$project->before_comment}}
                        </p>
                        <div class="icon icon-primary">
                          <i class="fa fa-quote-right"></i>
                        </div>
                      </div>
                      <div class="card-footer ">
                        <h4 class="card-title">{{$user->last_name}}　{{$user->first_name}}</h4>
                        <p class="category">{{$user->name}}</p>
                      </div>
                      <button class="btn btn-success" id="confirm_bc">ブロックチェーンに確認</button>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="card card-pricing ">
                          <h6 class="card-category"> このプロジェクトの応援者</h6>
                          <div class="card-body">
                            <div class="card-icon icon-primary ">
                              <i class="now-ui-icons emoticons_satisfied"></i>
                            </div>
                            <h3 class="card-title"><span id="cheerNum">{{$cheer}}</span><small>人</small></h3>
                            <ul>
                              <li>登録日：{{$project->created_at}}</li>
                              <li>期限：{{$project->limit_data}}</li>
                            </ul>
                          </div>
                          <div class="card-footer" id="cheerButton">
                            @if($project->created_user_id==Auth::user()->id)
                              <div class="btn btn-round btn-default">あなたのプロジェクトです</div>
                            @elseif($cheer_check==true)
                              <div class="btn btn-round btn-default" id="cheer_down">応援を解除する</div>
                            @else
                              <a href="#" class="btn btn-round btn-primary" id="cheer_up">応援する！</a>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-sm-12">
                    <div class="card">
                      <h4>プロジェクトの詳細</h4>
                      {{$project->project_detail}}
                      <h4>ブロジェクトのゴール</h4>
                      {{$project->project_goal}}
                      <br><br><br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 text-center">
        <div class="card card-contributions">
          <div class="card  card-tasks">
            <div class="card-header ">
              <h4 class="card-title">タスク</h4>
            </div>
            <div class="card-body ">
              <div class="table-full-width table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" checked>
                            <span class="form-check-sign"></span>
                          </label>
                        </div>
                      </td>
                      <td class="text-left">必要な工程を全て洗い出す</td>
                      <td class="td-actions text-right">
                        <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                          <i class="now-ui-icons ui-2_settings-90"></i>
                        </button>
                        <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                          <i class="now-ui-icons ui-1_simple-remove"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox">
                            <span class="form-check-sign"></span>
                          </label>
                        </div>
                      </td>
                      <td class="text-left">カテゴリランクC未満の未処理案件の実行を全て終わらせる</td>
                      <td class="td-actions text-right">
                        <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                          <i class="now-ui-icons ui-2_settings-90"></i>
                        </button>
                        <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                          <i class="now-ui-icons ui-1_simple-remove"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" checked>
                            <span class="form-check-sign"></span>
                          </label>
                        </div>
                      </td>
                      <td class="text-left">１ヶ月前までには、期日に達成できるかの大まかな見込みを立てられるようにする
                      </td>
                      <td class="td-actions text-right">
                        <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                          <i class="now-ui-icons ui-2_settings-90"></i>
                        </button>
                        <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                          <i class="now-ui-icons ui-1_simple-remove"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
  <meta name="token" content="{{ csrf_token() }}">
  <script>
    //ブロックチェーンに内容の正しさを確認
    $(function(){
        $('#confirm_bc').click(function(){
            $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                type:'POST', 
                url:'./confirm_bc',
                data: {'blockchain_id': "{{$project->blockchain_id}}" ,
                        'project_name':"{{$project->project_name}}",
                        'project_detail':"{{$project->project_detail}}"
                }
            }).done(function (res){
              if(res == 1){
                Swal.fire({
                title: "内容の確認ができました。",
                text: "この内容は、確かに「{{$project->created_at}}」に記録されてから変更されていません。",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
              });
              }else{
                Swal.fire({
                title: "この内容は変更されています",
                text: "ブロックチェーンに書き込まれた内容と一致しませんでした",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-warning",
                type: "warning"
              });
              }
            }).fail(function(){
              alert("読み込みに失敗しました");
            });
        });
    });

    $(function(){
      let cheerNum = {{$cheer}};
      //Cheerを加算
      $('#cheer_up').click(function(){
      cheerNum++;
      $('#cheerNum').html(cheerNum);
      $('#cheerButton').html('<div class="btn btn-round btn-default" id="cheer_down">応援を解除する</div>');
          $.ajax({
              headers: {
                          'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
              },
              type:'POST', 
              url:'./cheer_up',
              data: {'project_id': {{$project->id}},'cheer_user_id': {{Auth::user()->id}}}
          }).done(function (){
            cheerUpNotice('top','right');
          }).fail(function(){
            alert('ファイルの取得に失敗しました');
          });
        });
      //Cheerを解除
      
      $('#cheer_down').click(function(){
        cheerNum--;
        $('#cheerNum').html(cheerNum);
        $('#cheerButton').html('<a href="#" class="btn btn-round btn-primary" id="cheer_up">応援する！</a>');
          $.ajax({
              headers: {
                          'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
              },
              type:'POST', 
              url:'./cheer_down',
              data: {'project_id': {{$project->id}},'cheer_user_id': {{Auth::user()->id}}}
          }).done(function (){
            cheerDownNotice('top','right');
          }).fail(function(){
            alert('ファイルの取得に失敗しました');
          });
        });
    });
  </script>
  <script>
    //CheerUpのNotification
    let cheerUpNotice = function(from, align) {
    color = 'info';
    $.notify({
      icon: "now-ui-icons emoticons_satisfied",
      message: "{{$user->name}}さんをCheerUpしました。"

    }, {
      type: color,
      timer: 300,
      placement: {
        from: from,
        align: align
        }
      });
    }
  //CheerDownのNotification
  let cheerDownNotice = function(from, align) {
    color = 'warning';
    $.notify({
      icon: "now-ui-icons emoticons_satisfied",
      message: "{{$user->name}}さんへのCheerを解除しました。"

    }, {
      type: color,
      timer: 300,
      placement: {
        from: from,
        align: align
      }
    });
  }
</script>
@endsection


