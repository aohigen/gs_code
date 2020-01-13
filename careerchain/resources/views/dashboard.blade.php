@extends('layouts.base')
@section('content')
  <div class="panel-header panel-header-lg">
    <canvas id="bigDashboardChart"></canvas>
  </div>
  
  <div class="content">
    <div class="row">
    <div class="col-md-12">
      <div class="card card-stats">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <div class="statistics">
                <div class="info">
                  <div class="icon icon-primary">
                    <i class="now-ui-icons ui-2_chat-round"></i>
                  </div>
                  <h3 class="info-title">{{$token}}<span>cc</span></h3>
                  <h6 class="stats-title">トークン</h6>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="statistics">
                <div class="info">
                  <div class="icon icon-success">
                    <i class="now-ui-icons business_money-coins"></i>
                  </div>
                  <h3 class="info-title">
                    <small>$</small>{{$income}}</h3>
                  <h6 class="stats-title">収益</h6>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="statistics">
                <div class="info">
                  <div class="icon icon-danger">
                    <i class="now-ui-icons objects_diamond"></i>
                  </div>
                  <h3 class="info-title">{{$staked}}</h3>
                  <h6 class="stats-title">ステークホルダー</h6>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="statistics">
                <div class="info">
                  <div class="icon icon-info">
                    <i class="now-ui-icons users_single-02"></i>
                  </div>
                  <h3 class="info-title">{{$followed}}</h3>
                  <h6 class="stats-title">フォロワー</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @foreach ($projects as $project)
      <div class="col-lg-4">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category"><span class="text-primary">{{DB::table('users')->where('id',$project->created_user_id)->value('name')}}</span>さんのワーク</h5>
            <h4 class="card-title">{{$project->project_name}}</h4>
            <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">注目！</a>
                <a class="dropdown-item" href="#">応援する</a>
                <a class="dropdown-item text-danger" href="#">非表示にする</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-area">
              @if(DB::table('users')->where('id',$project->created_user_id)->value('main_img')==null)
            <img src="img/image_placeholder.jpg" style="width:100%;height:220px">
            @else
            <img src="upload/main/{{DB::table('users')->where('id',$project->created_user_id)->value('main_img')}}" style="width:100%;height:220px">
            @endif
            </div>

          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="now-ui-icons tech_watch-time"></i> {{$project->created_at}}
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
<script>
  $(document).ready(function() {
    // Javascript method's body can be found in assets/js/demos.js
    demo.initDashboardPageCharts();

    demo.initVectorMap();

  });
</script>
@endsection
