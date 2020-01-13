
@extends('layouts.base')
@section('content')
<div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">あなたのフォロワー</h4>
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
                    @foreach ($followers as $follower)
                      <tr>
                        <td class="text-center" style="width:100px">
                          <div class="img-container">
                            <a href="./user?uid={{$follower->user_id}}">
                            @if($follower->profile_img==null)
                              <img src="img/placeholder.jpg" alt="{{$follower->name}}">
                            @else
                              <img src="upload/profile/{{$follower->profile_img}}" alt="{{$follower->name}}">
                            @endif
                            </a>
                          </div>
                        </td>
                        <td>
                          <a href="./user?uid={{$follower->user_id}}">{{$follower->name}}</a>
                          <br />
                          <small>{{$follower->last_name}} {{$follower->first_name}}</small>
                        </td>
                        <td>
                        {{$follower->work_company}}
                        </td>
                        <td>
                        {{$follower->catchcopy}}
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


