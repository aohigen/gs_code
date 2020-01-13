
@extends('layouts.base')
@section('content')
<div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">あなたのステークホルダー</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                    <th></th>
                      <th>
                        Name
                      </th>
                      <th>
                        Company
                      </th>
                      <th>
                        Catchcopy
                      </th>
                    </thead>
                    <tbody>
                    @foreach ($stakers as $staker)
                      <tr>
                        <td class="text-center" style="width:100px">
                          <div class="img-container">
                            <a href="./user?uid={{$staker->user_id}}">
                            @if($staker->profile_img==null)
                              <img src="img/placeholder.jpg" alt="{{$staker->name}}">
                            @else
                              <img src="upload/profile/{{$staker->profile_img}}" alt="{{$staker->name}}">
                            @endif
                            </a>
                          </div>
                        </td>
                        <td>
                          <a href="./user?uid={{$staker->user_id}}">{{$staker->name}}</a>
                          <br />
                          <small>{{$staker->last_name}} {{$staker->first_name}}</small>
                        </td>
                        <td>
                        {{$staker->work_company}}
                        </td>
                        <td>
                        {{$staker->catchcopy}}
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
@endsection


