@extends('layouts.base')
@section('content')
<div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="header text-center">
          <h3 class="title">Timeline</h3>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-timeline card-plain">
              <div class="card-body">
                <ul class="timeline">
                @foreach ($projects as $project)
                  @if($users[$project->created_user_id-1]->name === Auth::user()->name)
                    <li class="timeline-inverted">
                    @else
                    <li>
                  @endif
                  @if($users[$project->created_user_id-1]->name === Auth::user()->name)
                    <div class="timeline-badge success">
                    @else
                    <div class="timeline-badge warning">
                  @endif
                      <i class="now-ui-icons objects_planet"></i>
                    </div>
                    <div class="timeline-panel">
                      <div class="timeline-heading">
                      @if($users[$project->created_user_id-1]->name === Auth::user()->name)
                        <span class="badge badge-success">
                        @else
                        <span class="badge badge-warning">
                      @endif
                          {{$users[$project->created_user_id-1]->name}}</span>
                      </div>
                      <div class="timeline-body">
                        {{$project->project_name}}
                        <p>{{$project->project_detail}}</p>
                      </div>
                      <h6>
                        <i class="ti-time"></i> {{$project->created_at}}
                      </h6>
                      <br>
                      <div class="timeline-footer">
                        <div class="dropdown">
                          <button type="button" class="btn btn-round btn-info dropdown-toggle" data-toggle="dropdown">
                            <i class="now-ui-icons design_bullet-list-67"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                          </div>
                        </div>
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