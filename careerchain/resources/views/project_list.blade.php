@extends('layouts.base')
@section('content')
<div class="panel-header">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">プロジェクト一覧</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>プロジェクト名</th>
                      <th>目標</th>
                      <th>期限</th>
                      <th>意気込み</th>
                      <th class="disabled-sorting text-right">操作</th>
                    </tr>
                  </thead>
                  <!-- <tfoot>
                    <tr>
                      <th>プロジェクト名</th>
                      <th>目標</th>
                      <th>期限</th>
                      <th>意気込み</th>
                      <th class="disabled-sorting text-right">操作</th>
                    </tr>
                  </tfoot> -->
                  <tbody>
                  @foreach ($projects as $project)
                    <tr>
                      <td>{{$project->project_name}}</td>
                      <td>{{$project->project_goal}}</td>
                      <td>{{$project->limit_date}}</td>
                      <td>{{$project->before_comment}}</td>
                      <td class="text-right">
                        <a href="#" class="btn btn-round btn-info btn-icon btn-sm like"><i class="fas fa-heart"></i></a>
                        <a href="#" class="btn btn-round btn-warning btn-icon btn-sm edit"><i class="far fa-calendar-alt"></i></a>
                        <a href="#" class="btn btn-round btn-danger btn-icon btn-sm remove"><i class="fas fa-times"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- end content-->
            </div>
            <!--  end card  -->
          </div>
          <!-- end col-md-12 -->
        </div>
        <!-- end row -->
      </div>
@endsection


