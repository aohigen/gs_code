
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
                        名前
                      </th>
                      <th>
                        トークン
                      </th>
                      <th class="text-center">
                        Staked
                      </th>
                      <th class="text-right">
                        Followed
                      </th>
                      <th class="text-right">
                        Stakes
                      </th>
                      <th class="text-right">
                        Follows
                      </th>
                      <th class="text-right">
                        address
                      </th>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                      <tr>
                        <td class="text-center" style="width:100px">
                            <div class="img-container">
                                <img src="upload/profile/{{$user->profile_img}}" alt="{{$user->name}}">
                            </div>
                        </td>
                        <td>
                        <a href="#jacket">{{$user->name}}</a>
                          <br />
                          <small>{{$user->last_name}} {{$user->first_name}}</small>
                        </td>
                        <td>
                        {{$user->token}}
                        </td>
                        <td class="text-center">
                        {{$user->staked}}
                        </td>
                        <td class="text-right">
                        {{$user->followed}}
                        </td>
                        <td class="text-right">
                        {{$user->stakes}}
                        </td>
                        <td class="text-right">
                        {{$user->follows}}
                        </td>
                        <td class="text-right">
                        {{$user->token_address}}
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

@endsection


