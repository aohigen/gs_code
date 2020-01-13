
@extends('layouts.base')
@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> ユーザー一覧</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                  <th class="text-center">
                  <div class="font-icon-detail">
                  <i class="now-ui-icons users_circle-08"></i>
                </div>
                  </th>
                  <th>
                    name
                  </th>
                  <th>
                    Company/Position
                  </th>
                  <th class="text-center">
                    Industry
                  </th>
                  <th class="text-right">
                    Stakes
                  </th>
                  <th class="text-right">
                    Staked
                  </th>
                  <th class="text-right">
                    Actions
                  </th>
                </thead>
                <tbody>
                @foreach ($users as $user)
                  <tr style="height:150px">
                    <td class="text-center" style="width:100px">
                        <div class="img-container">
                          <a href="./user?uid={{$user->id}}">
                          @if($user->profile_img==null)
                            <img src="img/placeholder.jpg" alt="{{$user->name}}">
                          @else
                            <img src="upload/profile/{{$user->profile_img}}" alt="{{$user->name}}">
                          @endif
                          </a>
                        </div>
                    </td>
                    <td>
                    <a href="./user?uid={{$user->id}}">{{$user->name}}</a>
                      <br />
                      <small>{{$user->last_name}} {{$user->first_name}}</small>
                    </td>
                    <td>
                    {{$user->work_company}}
                    <br />
                      <small>{{$user->work_position}}</small>
                    </td>
                    <td class="text-center">
                    {{$user->work_industry}}
                    </td>
                    <td class="text-right">
                    {{$user->vote_token}}
                    </td>
                    <td class="text-right">
                    {{$user->cc_token}}
                    </td>
                    <td class="text-right">
                      <span class="follow_area_{{$user->id}}">
                        @if(DB::table('follows')->where('unique_check',Auth::user()->id.'.'.$user->id)->exists() == true)
                          <button type="button" rel="tooltip" class="btn btn-default unfollow_btn" value="{{$user->id}}">
                          <i class="now-ui-icons gestures_tap-01"></i><small> フォロー解除</small>
                        @else
                          <button type="button" rel="tooltip" class="btn btn-info follow_btn" value="{{$user->id}}">
                          <i class="now-ui-icons gestures_tap-01"></i><small> フォローする</small>
                        @endif
                          </button>
                      </span>
                        <br><br>
                      <span class="stake_area_{{$user->id}}">
                        @if(DB::table('stakes')->where('unique_check',Auth::user()->id.'.'.$user->id)->exists() == true)
                          <button type="button" rel="tooltip" class="btn btn-default unstake_btn" value="{{$user->id}}">
                          <i class="now-ui-icons objects_diamond"></i><small> ステーク解除</small>
                        @else
                          <button type="button" rel="tooltip" class="btn btn-danger stake_btn" value="{{$user->id}}">
                          <i class="now-ui-icons objects_diamond"></i><small> ステークする</small>
                        @endif
                          </button>
                      </span>
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

<meta name="token" content="{{ csrf_token() }}">
<script>
    //フォロー実行のajax
    $(function(){
        $('.follow_btn').click(function(){
            let uid = $(this).val();
            $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                type:'POST', 
                url:'./follow',
                data: {'user_id': {{Auth::user()->id}},'followed_user_id': uid}
            }).done(function (){
                $('.follow_area_'+uid).html('<button type="button" rel="tooltip" class="btn btn-default unfollow_btn" value="'+uid+'"><i class="now-ui-icons gestures_tap-01"></i><small> フォロー解除</small>');
                followUpNotice('top','right');
            }).fail(function(){
              alert('ファイルの取得に失敗しました');
            });
        });
    });
    //フォロー解除のajax
    $(function(){
    $('.unfollow_btn').click(function(){
        let uid = $(this).val();
        $.ajax({
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            },
            type:'POST', 
            url:'./unfollow',
            data: {'user_id': {{Auth::user()->id}},'followed_user_id': uid}
        }).done(function (){
            $('.follow_area_'+uid).html('<button type="button" rel="tooltip" class="btn btn-info follow_btn" value="'+uid+'"><i class="now-ui-icons gestures_tap-01"></i><small> フォローする</small>');
            followDownNotice('top','right');
        }).fail(function(){
          alert('ファイルの取得に失敗しました'+{{Auth::user()->id}}+' '+uid);
        });
      });
    });
    // ステーク実行のajax
    $(function(){
        $('.stake_btn').click(function(){
            let uid = $(this).val();
            $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                type:'POST', 
                url:'./stake',
                data: {'user_id': {{Auth::user()->id}},'staked_user_id': uid}
            }).done(function (){
              $('.stake_area_'+uid).html('<button type="button" rel="tooltip" class="btn btn-default unstake_btn" value="'+uid+'"><i class="now-ui-icons gestures_tap-01"></i><small> ステーク解除</small>');
              stakeUpNotice('top','right');
            }).fail(function(){
                alert('ファイルの取得に失敗しました');
            });
        });
    });
    // ステーク解除のajax
    $(function(){
    $('.unstake_btn').click(function(){
        let uid = $(this).val();
        $.ajax({
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            },
            type:'POST', 
            url:'./unstake',
            data: {'user_id': {{Auth::user()->id}},'staked_user_id': uid}
        }).done(function (){
          $('.stake_area_'+uid).html('<button type="button" rel="tooltip" class="btn btn-danger stake_btn" value="'+uid+'"><i class="now-ui-icons objects_diamond"></i><small> ステークする</small>');
          stakeDownNotice('top','right');
        }).fail(function(){
            alert('ファイルの取得に失敗しました');
        });
      });
    });
    
  //notification
  //フォローのNotification
  let followUpNotice = function(from, align) {
    color = 'info';
    $.notify({
      icon: "now-ui-icons emoticons_satisfied",
      message: "{{$user->name}}さんをフォローしました。"

    }, {
      type: color,
      timer: 300,
      placement: {
        from: from,
        align: align
        }
      });
    }
  //フォロー解除のNotification
  let followDownNotice = function(from, align) {
    color = 'warning';
    $.notify({
      icon: "now-ui-icons emoticons_satisfied",
      message: "{{$user->name}}さんへのフォローを解除しました。"

    }, {
      type: color,
      timer: 300,
      placement: {
        from: from,
        align: align
      }
    });
  }
    //ステークのNotification
    let stakeUpNotice = function(from, align) {
    color = 'info';
    $.notify({
      icon: "now-ui-icons emoticons_satisfied",
      message: "{{$user->name}}さんのステークホルダーになりました。"

    }, {
      type: color,
      timer: 300,
      placement: {
        from: from,
        align: align
        }
      });
    }
  //ステーク解除のNotification
  let stakeDownNotice = function(from, align) {
    color = 'warning';
    $.notify({
      icon: "now-ui-icons emoticons_satisfied",
      message: "{{$user->name}}さんへのステークを解除しました。"

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


