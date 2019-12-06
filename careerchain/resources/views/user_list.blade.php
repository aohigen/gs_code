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
                        Company
                      </th>
                      <th class="text-center">
                        Job Position
                      </th>
                      <th class="text-right">
                        Votes
                      </th>
                      <th class="text-right">
                        Voted
                      </th>
                      <th class="text-right">
                        Actions
                      </th>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                      <tr>
                        <td class="text-center" style="width:100px">
                            <div class="img-container">
                                <img src="upload/profile/{{$user->profile_img}}" alt="{{$user->nick_name}}">
                            </div>
                        </td>
                        <td>
                        <a href="#jacket">{{$user->nick_name}}</a>
                          <br />
                          <small>{{$user->last_name}} {{$user->first_name}}</small>
                        </td>
                        <td>
                        {{$user->work_company}}
                        </td>
                        <td class="text-center">
                        {{$user->work_position}}
                        </td>
                        <td class="text-right">
                        {{$user->vote_token}}
                        </td>
                        <td class="text-right">
                        {{$user->cc_token}}
                        </td>
                        <td class="text-right">
                          <button type="button" rel="tooltip" class="btn btn-info btn-icon btn-sm ">
                            <i class="now-ui-icons users_single-02"></i>
                          </button>
                            <button type="button" rel="tooltip" class="btn btn-success btn-icon btn-sm follow_btn" value="{{$user->user_id}}">
                                <i class="now-ui-icons gestures_tap-01"></i>
                            </button>
                          <button type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm ">
                            <i class="now-ui-icons objects_diamond"></i>
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

<meta name="token" content="{{ csrf_token() }}">
<script>
    $(function(){
        $('.follow_btn').click(function(){
            let uid = $(this).val();
            console.log(uid);
            $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                type:'POST', 
                url:'./follow',
                data: {'user_id': {{Auth::user()->id}},'followed_user_id': uid}
            }).done(function (){
                $('#follow').html("成功");//展開したいタグのidを指定
            }).fail(function(){
                alert('ファイルの取得に失敗しました。'+uid);
            });
        });
    });

    
</script>
@endsection


