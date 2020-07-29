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
                <p class="msg">{{session('msg')}}</p>
                <ul>
                  @foreach($errors->all() as $error)
                    <li class="msg">{{$error}}</li>
                  @endforeach
                </ul>
                    <div class="sub_container">
                        <form method="POST" action="/re_submit/{{$index->retrieved_task}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <ul class="nav nav-tabs">
                                <li class="nav-item active">
                                    <a href="#general" class="nav-link" data-toggle="tab">概要</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#explanation" class="nav-link" data-toggle="tab">説明</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#document" class="nav-link" data-toggle="tab">資料</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#route" class="nav-link" data-toggle="tab">ルート</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#comment" class="nav-link" data-toggle="tab">コメント</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="general" class="tab-pane active">
                                    <p>件名</p>
                                    <input class="title_length" type="text" name="title" value="{{ $index->title }}">
                                    <p>登録日</p>
                                    <input type="date" name="registered_date" value="{{ $var_date }}">
                                </div>
                                <div id="explanation" class="tab-pane">
                                    <textarea name="explanation" class="explanation_box">{{ $index->explanation}}</textarea>
                                </div>
                                <div id="document" class="tab-pane">
                                  <p>依頼文等</p>
                                  <div>
                                    <input type="file" id="file" name="file_1" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{$index->file_1}}">{{ $index->file_1 }}</a>
                                    @isset($index->file_1)
                                      <a class="discard_btn" href="/modification_file_del/{{ $index->retrieved_task }}/{{ 'file_1' }}">☓</a>
                                    @endisset
                                  </div>
                                  <div>
                                    <input type="file" id="file" name="file_2" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{$index->file_2}}">{{ $index->file_2 }}</a>
                                    @isset($index->file_2)
                                      <a class="discard_btn" href="/modification_file_del/{{ $index->retrieved_task }}/{{ 'file_2' }}">☓</a>
                                    @endisset
                                  </div>
                                  <div>
                                    <input type="file" id="file" name="file_3" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{$index->file_3}}">{{ $index->file_3 }}</a>
                                    @isset($index->file_3)
                                      <a class="discard_btn" href="/modification_file_del/{{ $index->retrieved_task }}/{{ 'file_3' }}">☓</a>
                                    @endisset
                                  </div>
                                  <div>
                                    <input type="file" id="file" name="file_4" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{$index->file_4}}">{{ $index->file_4 }}</a>
                                    @isset($index->file_4)
                                      <a class="discard_btn" href="/modification_file_del/{{ $index->retrieved_task }}/{{ 'file_4' }}">☓</a>
                                    @endisset
                                  </div>
                                  <p>参考資料</p>
                                  <div>
                                    <input type="file" id="file" name="ref_1" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{$index->ref_1}}">{{ $index->ref_1 }}</a>
                                    @isset($index->ref_1)
                                      <a class="discard_btn" href="/modification_file_del/{{ $index->retrieved_task }}/{{ 'ref_1' }}">☓</a>
                                    @endisset
                                  </div>
                                  <div>
                                    <input type="file" id="file" name="ref_2" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{$index->ref_2}}">{{ $index->ref_2 }}</a>
                                    @isset($index->ref_2)
                                      <a class="discard_btn" href="/modification_file_del/{{ $index->retrieved_task }}/{{ 'ref_2' }}">☓</a>
                                    @endisset
                                  </div>
                                  <div>
                                    <input type="file" id="file" name="ref_3" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{$index->ref_3}}">{{ $index->ref_3 }}</a>
                                    @isset($index->ref_3)
                                      <a class="discard_btn" href="/modification_file_del/{{ $index->retrieved_task }}/{{ 'ref_3' }}">☓</a>
                                    @endisset
                                  </div>
                                  <div>
                                  </div>
                                    <input type="file" id="file" name="ref_4" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{$index->ref_4}}">{{ $index->ref_4 }}</a>
                                    @isset($index->ref_4)
                                      <a class="discard_btn" href="/modification_file_del/{{ $index->retrieved_task }}/{{ 'ref_4' }}">☓</a>
                                    @endisset
                                  </div>
                                  
                                <div id="route" class="tab-pane route_box">
                                   <p>担当者：
                                    {{ Auth::User()->name }}
                                   </p>
                                   <p class="pointer">⬇</p>
                                   <p>関与者1
                                   @php
                                   $cnt = 0;
                                   @endphp

                                    @if($index->auth_1 !== $index->name)
                                    ：{{ $index->auth_1 }}（承認済み）
                                    <input type="hidden" name="auth_1" value="{{ $index->auth_1 }}">
                                    @else
                                     <select name="auth_1" class="auth_select" id="auth_1">
                                       @if($cnt >= 1)
                                         <option>---</option>
                                       @endif
                                       @php
                                          $cnt++
                                       @endphp
                                        @foreach($data as $val)
                                            @if($val->name === $index->auth_1 && empty(old('auth_1')))
                                              <option selected>{{$val->name}}</option>
                                            @else
                                              <option @if(old('auth_1') === $val->name) selected  @endif>{{$val->name}}</option>
                                            @endif
                                        @endforeach
                                     </select>
                                        @php
                                          $cnt++
                                        @endphp
                                    @endif

                                   </p>
                                   <p class="pointer">⬇</p>
                                   <p>関与者2

                                   @if($index->auth_2 !== $index->name && $cnt === 0)
                                    ：{{ $index->auth_2 }}（承認済み）
                                    <input type="hidden" name="auth_2" value="{{ $index->auth_2 }}">
                                   @else
                                     <select name="auth_2" class="auth_select" id="auth_2">
                                       @if($cnt >= 1)
                                         <option>---</option>
                                       @endif
                                       @php
                                          $cnt++
                                       @endphp
                                        @foreach($data as $val)
                                            @if($val->name === $index->auth_2 && empty(old('auth_2')))
                                              <option selected>{{$val->name}}</option>
                                            @else
                                              <option @if(old('auth_2') === $val->name) selected  @endif>{{$val->name}}</option>
                                            @endif
                                        @endforeach
                                     </select>
                                      
                                   @endif

                                   </p>
                                   <p class="pointer">⬇</p>
                                   <p>関与者3

                                   @if($index->auth_3 !== $index->name && $cnt === 0)
                                    ：{{ $index->auth_3 }}（承認済み）
                                    <input type="hidden" name="auth_3" value="{{ $index->auth_3 }}">
                                   @else
                                     <select name="auth_3" class="auth_select" id="auth_3">
                                       @if($cnt >= 1)
                                        <option>---</option>
                                       @endif
                                       @php
                                          $cnt++
                                       @endphp
                                        @foreach($data as $val)
                                            @if($val->name === $index->auth_3 && empty(old('auth_3')))
                                              <option selected>{{$val->name}}</option>
                                            @else
                                              <option @if(old('auth_3') === $val->name) selected  @endif>{{$val->name}}</option>
                                            @endif
                                        @endforeach
                                     </select>
                                      
                                   @endif

                                   </p>
                                   <p class="pointer">⬇</p>
                                   <p>関与者4

                                   @if($index->auth_4 !== $index->name && $cnt === 0)
                                    ：{{ $index->auth_4 }}（承認済み）
                                    <input type="hidden" name="auth_4" value="{{ $index->auth_4 }}">
                                   @else
                                     <select name="auth_4" class="auth_select" id="auth_4">
                                       @if($cnt >= 1)
                                        <option>---</option>
                                       @endif
                                       @php
                                          $cnt++
                                       @endphp
                                        @foreach($data as $val)
                                            @if($val->name === $index->auth_4 && empty(old('auth_4')))
                                              <option selected>{{$val->name}}</option>
                                            @else
                                              <option @if(old('auth_4') === $val->name) selected  @endif>{{$val->name}}</option>
                                            @endif
                                        @endforeach
                                     </select>
                                      
                                   @endif

                                   </p>
                                   <p class="pointer">⬇</p>
                                   <p>関与者5

                                   @if($index->auth_5 !== $index->name && $cnt === 0)
                                    ：{{ $index->auth_5 }}
                                    <input type="hidden" name="auth_5" value="{{ $index->auth_5 }}">
                                   @else
                                     <select name="auth_5" class="auth_select" id="auth_5">
                                       @if($cnt >= 1)
                                         <option>---</option>
                                       @endif
                                        @foreach($data as $val)
                                            @if($val->name === $index->auth_5 && empty(old('auth_5')))
                                              <option selected>{{$val->name}}</option>
                                            @else
                                              <option @if(old('auth_5') === $val->name) selected  @endif>{{$val->name}}</option>
                                            @endif
                                        @endforeach
                                     </select>
                                    @endif

                                   </p>
                                
                                </div>
                                <div id="comment" class="tab-pane">
                                    <p name="explanation" class="explanation_box">{{ $index->comment}}</p>
                                </div>
                            </div>

                            <button class="btn submit" name="submit" value="submit_1">差し戻し者へ提出</button>
                            <button class="btn re_submit_btn submit" name="submit" value="submit_2">再提出</button>
                            <button class="btn discard_btn" name="submit" value="submit_3">破棄</button>
                        </form>
                      </div>
                      <a class="modification_back_btn" href="{{ $back }}">戻る</a>

            </div>
        </div>
    </div>
</div>
@endsection
