@extends('layouts.base')
@section('content')
<div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="header text-center">
          <h3 class="title">Timeline</h3>
        </div>
        <div class="row">
          <div class="col-md-6">
            <h4 class="card-title">みんなのワーク</h4>
          </div>
          <div class="col-md-6">
            <h4 class="card-title">あなたのワーク</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-timeline card-plain">
              <div class="card-body">
                <ul class="timeline">
                @foreach ($projects as $project)
                  @if(DB::table('users')->where('id',$project->created_user_id)->value('name') === Auth::user()->name)
                    <li class="timeline-inverted">
                    @else
                    <li>
                  @endif
                  @if(DB::table('users')->where('id',$project->created_user_id)->value('name') === Auth::user()->name)
                    <div class="timeline-badge success">
                    @else
                    <div class="timeline-badge warning">
                  @endif
                      <i class="now-ui-icons objects_planet"></i>
                    </div>
                    <div class="timeline-panel">
                      <div class="timeline-heading">
                      @if(DB::table('users')->where('id',$project->created_user_id)->value('profile_img')==null)
                        <img src="img/placeholder.jpg"  style="width:40px">
                      @else
                        <img src="upload/profile/{{DB::table('users')->where('id',$project->created_user_id)->value('profile_img')}}" style="width:40px">
                      @endif
                      @if(DB::table('users')->where('id',$project->created_user_id)->value('name') === Auth::user()->name)
                        <span class="badge badge-success" style="margin:0px 0px 0px 5px">
                        @else
                        <span class="badge badge-warning" style="margin:0px 0px 0px 5px">
                      @endif
                          {{DB::table('users')->where('id',$project->created_user_id)->value('name')}}</span>
                      </div>
                      <div class="timeline-body">
                        <h5>
                          <a href="./project_detail?pid={{$project->id}}">
                            {{$project->project_name}}
                          </a>
                        </h5>
                        <p>{{$project->project_detail}}</p>
                      </div>
                      <h6>
                        <i class="ti-time"></i> {{$project->created_at}}
                      </h6>
                      <br>
                      <div class="timeline-footer">
                        <div class="dropdown" style="margin:0px 10px 0px 0px">
                          <button type="button" class="btn btn-round btn-info dropdown-toggle" data-toggle="dropdown">
                            <i class="now-ui-icons design_bullet-list-67"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="./project_detail?pid={{$project->id}}">プロジェクトを見る</a>
                            <a class="dropdown-item" href="./user?uid={{DB::table('users')->where('id',$project->created_user_id)->value('id')}}">ユーザー情報を見る</a>
                          </div>
                        </div>
                        <a href="./action"><i class="now-ui-icons emoticons_satisfied" style="margin:0px 5px 0px 0px"></i></a>
                        <a href="./action"><i class="now-ui-icons users_single-02" style="margin:0px 5px 0px 0px"></i></a>
                        <a href="./action"><i class="now-ui-icons objects_diamond" style="margin:0px 5px 0px 0px"></i></a>
                      </div>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection