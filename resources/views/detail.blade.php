@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $belonging }}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif    
                </div>
                    <div class="sub_container">
                        <ul class="nav nav-tabs">
                            <li class="nav-item active">
                                <a href="#general" class="nav-link" data-toggle="tab">概要</a>
                            </li>
                            <li class="nav-item">
                                <a href="#document" class="nav-link" data-toggle="tab">資料</a>
                            </li>
                            <li class="nav-item">
                                <a href="#route" class="nav-link" data-toggle="tab">ルート</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="general" class="tab-pane active">
                                <p>件名</p>
                                  <p class="detail_general_box">{{$index->title}}</p>
                                <p>登録日</p>
                                  <span>{{ date('y.n.j', strtotime($index->created_at)) }}</span> 
                                <p>説明文</p>
                                  <p class="detail_general_box detail_explanation_box">{{$index->explanation}}</p>
                            </div>
                            <div id="document" class="tab-pane">
                              <ul>
                                <p>依頼文等</p>
                                <li><a href="/storage/files/{{$index->file_1}}">{{ $index->file_1 }}</a></li>
                                <li><a href="/storage/files/{{$index->file_2}}">{{ $index->file_2 }}</a></li>
                                <li><a href="/storage/files/{{$index->file_3}}">{{ $index->file_3 }}</a></li>
                                <li><a href="/storage/files/{{$index->file_4}}">{{ $index->file_4 }}</a></li>
                                <p>参考資料</p>
                                <li><a href="/storage/files/{{$index->ref_1}}">{{ $index->ref_1 }}</a></li>                               
                                <li><a href="/storage/files/{{$index->ref_2}}">{{ $index->ref_2 }}</a></li>
                                <li><a href="/storage/files/{{$index->ref_3}}">{{ $index->ref_3 }}</a></li>
                                <li><a href="/storage/files/{{$index->ref_3}}">{{ $index->ref_4 }}</a></li> 
                              </ul>
                            </div>
                            <div id="route" class="tab-pane route_box">
                                <p>担当者：{{$index->name}}</p>
                                <p class="pointer">⬇</p>
                                <p>関与者1：{{$index->auth_1}}
                                  @if(isset($task_holder->name) && $index->auth_1 === $task_holder->name )
                                    （案件あり）
                                  @endif
                                </p>
                                <p class="pointer">⬇</p>
                                @if($index->auth_2 === NULL)
                                  <p>関与者2：--- 
                                @else
                                  関与者2：{{$index->auth_2}}
                                  @if(isset($task_holder->name) && $index->auth_2 === $task_holder->name )
                                    （案件あり）
                                  @endif
                                  </p>
                                @endif
                                <p class="pointer">⬇</p>
                                @if($index->auth_3 === NULL)
                                  <p>関与者3：--- 
                                @else
                                  関与者3：{{$index->auth_3}}
                                  @if(isset($task_holder->name) && $index->auth_3 === $task_holder->name )
                                    （案件あり）
                                  @endif
                                  </p>
                                @endif
                                <p class="pointer">⬇</p>
                                @if($index->auth_4 === NULL)
                                  <p>関与者4：--- 
                                @else
                                  関与者4：{{$index->auth_4}}
                                  @if(isset($task_holder->name) && $index->auth_4 === $task_holder->name )
                                    （案件あり）
                                  @endif
                                  </p>
                                @endif
                                <p class="pointer">⬇</p>
                                @if($index->auth_5 === NULL)
                                  <p>関与者5：--- 
                                @else
                                  関与者5：{{$index->auth_5}}
                                  @if(isset($task_holder->name) && $index->auth_5 === $task_holder->name )
                                    （案件あり）
                                  @endif
                                  </p>
                                @endif
                            </div>
                        </div>
                        <button class="btn"><a href="{{$back}}">戻る</a></button>                        
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
