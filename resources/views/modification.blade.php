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
                <p class="msg">{{ session('msg') }}</p>
                <ul>
                  @foreach($errors->all() as $error)
                    <li class="msg">{{ $error }}</li>
                  @endforeach
                  @isset($error)
                    <li class="msg">資料を添付していた場合は再度添付してください。</li> 
                  @endisset
                </ul>
                    <div class="sub_container">
                        <form method="POST" action="{{ route('re_submit',['id'=>$index->retrieved_task] )}}" enctype="multipart/form-data">
                            {{csrf_field()}}
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
                                    <p>説明文</p>
                                    <textarea name="explanation" class="explanation_box">{{ $index->explanation }}</textarea>
                                </div>
                                <div id="document" class="tab-pane">
                                  <p>依頼文等</p>
                                  <div>
                                    <input type="file" id="file" name="file_1" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{ Auth::User()->id }}/{{ $index->retrieved_task }}/file/{{ $index->file_1 }}">{{ $index->file_1 }}</a>
                                    @isset($index->file_1)
                                      <a class="discard_btn del" href="{{ route('modification_file_del', ['id'=>$index->retrieved_task, 'num'=>'file_1'] ) }}">☓</a>
                                    @endisset
                                  </div>
                                  <div>
                                    <input type="file" id="file" name="file_2" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{ Auth::User()->id }}/{{ $index->retrieved_task }}/file/{{ $index->file_2 }}">{{ $index->file_2 }}</a>
                                    @isset($index->file_2)
                                      <a class="discard_btn del" href="{{ route('modification_file_del', ['id'=>$index->retrieved_task, 'num'=>'file_2'] ) }}">☓</a>
                                    @endisset
                                  </div>
                                  <div>
                                    <input type="file" id="file" name="file_3" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{ Auth::User()->id }}/{{ $index->retrieved_task }}/file/{{ $index->file_3 }}">{{ $index->file_3 }}</a>
                                    @isset($index->file_3)
                                      <a class="discard_btn del" href="{{ route('modification_file_del', ['id'=>$index->retrieved_task, 'num'=>'file_3'] ) }}">☓</a>
                                    @endisset
                                  </div>
                                  <div>
                                    <input type="file" id="file" name="file_4" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{ Auth::User()->id }}/{{ $index->retrieved_task }}/file/{{ $index->file_4 }}">{{ $index->file_4 }}</a>
                                    @isset($index->file_4)
                                      <a class="discard_btn del" href="{{ route('modification_file_del', ['id'=>$index->retrieved_task, 'num'=>'file_4'] ) }}">☓</a>
                                    @endisset
                                  </div>
                                  <p>参考資料</p>
                                  <div>
                                    <input type="file" id="file" name="ref_1" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{ Auth::User()->id }}/{{ $index->retrieved_task }}/file/{{ $index->ref_1 }}">{{ $index->ref_1 }}</a>
                                    @isset($index->ref_1)
                                      <a class="discard_btn del" href="{{ route('modification_file_del', ['id'=>$index->retrieved_task, 'num'=>'ref_1'] ) }}">☓</a>
                                    @endisset
                                  </div>
                                  <div>
                                    <input type="file" id="file" name="ref_2" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{ Auth::User()->id }}/{{ $index->retrieved_task }}/file/{{ $index->ref_2 }}">{{ $index->ref_2 }}</a>
                                    @isset($index->ref_2)
                                      <a class="discard_btn del" href="{{ route('modification_file_del', ['id'=>$index->retrieved_task, 'num'=>'ref_2'] ) }}">☓</a>
                                    @endisset
                                  </div>
                                  <div>
                                    <input type="file" id="file" name="ref_3" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{ Auth::User()->id }}/{{ $index->retrieved_task }}/file/{{ $index->ref_3 }}">{{ $index->ref_3 }}</a>
                                    @isset($index->ref_3)
                                      <a class="discard_btn del" href="{{ route('modification_file_del', ['id'=>$index->retrieved_task, 'num'=>'ref_3'] ) }}">☓</a>
                                    @endisset
                                  </div>
                                  <div>
                                  </div>
                                    <input type="file" id="file" name="ref_4" class="file_tag">
                                    <a class="file_link" href="/storage/files/{{ Auth::User()->id }}/{{ $index->retrieved_task }}/file/{{ $index->ref_4 }}">{{ $index->ref_4 }}</a>
                                    @isset($index->ref_4)
                                      <a class="discard_btn del" href="{{ route('modification_file_del', ['id'=>$index->retrieved_task, 'num'=>'ref_4'] ) }}">☓</a>
                                    @endisset
                                  </div>
                                  
                                <div id="route" class="tab-pane route_box">
                                   <p>担当者：
                                    {{ Auth::User()->name }}
                                   </p>
                                   <p class="pointer">⬇</p>
                                   <p>関与者1：
                                   @php
                                     $cnt = 0;
                                   @endphp

                                    @if($index->auth_1 !== $index->name)
                                      @foreach($get_role as $val)
                                        @if($val->name === $index->auth_1)
                                          {{ $val->role }}
                                        @endif
                                      @endforeach
                                      {{ $index->auth_1 }}（承認済み）
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
                                                <option value="{{ $val->name }}" selected>{{$val->role}}&nbsp;{{ $val->name }}</option>
                                              @else
                                                <option value="{{ $val->name }}" @if(old('auth_1') === $val->name) selected  @endif>{{ $val->role }}&nbsp;{{ $val->name }}</option>
                                              @endif
                                          @endforeach
                                      </select>
                                        @php
                                          $cnt++
                                        @endphp
                                    @endif

                                   </p>
                                   <p class="pointer">⬇</p>
                                   <p>関与者2：

                                   @if($index->auth_2 !== $index->name && $cnt === 0)
                                      @foreach($get_role as $val)
                                          @if($val->name === $index->auth_2)
                                            {{ $val->role }}
                                          @endif
                                      @endforeach
                                     {{ $index->auth_2 }}（承認済み）
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
                                              <option value="{{ $val->name }}" selected>{{$val->role}}&nbsp;{{ $val->name }}</option>
                                            @else
                                              <option value="{{ $val->name }}" @if(old('auth_2') === $val->name) selected  @endif>{{ $val->role }}&nbsp;{{ $val->name }}</option>
                                            @endif
                                         @endforeach
                                     </select>
                                   @endif

                                   </p>
                                   <p class="pointer">⬇</p>
                                   <p>関与者3：

                                   @if($index->auth_3 !== $index->name && $cnt === 0)
                                   　　@foreach($get_role as $val)
                                          @if($val->name === $index->auth_3)
                                            {{ $val->role }}
                                          @endif
                                      @endforeach
                                    　{{ $index->auth_3 }}（承認済み）
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
                                              <option value="{{ $val->name }}" selected>{{ $val->role }}&nbsp;{{ $val->name }}</option>
                                            @else
                                              <option value="{{ $val->name }}" @if(old('auth_3') === $val->name) selected  @endif>{{ $val->role }}&nbsp;{{ $val->name }}</option>
                                            @endif
                                         @endforeach
                                     </select>
                                      
                                   @endif

                                   </p>
                                   <p class="pointer">⬇</p>
                                   <p>関与者4：

                                   @if($index->auth_4 !== $index->name && $cnt === 0)
                                      @foreach($get_role as $val)
                                          @if($val->name === $index->auth_4)
                                            {{ $val->role }}
                                          @endif
                                      @endforeach
                                      {{ $index->auth_4 }}（承認済み）
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
                                              <option value="{{ $val->name }}" selected>{{$val->role}}&nbsp;{{ $val->name }}</option>
                                            @else
                                              <option value="{{ $val->name }}" @if(old('auth_4') === $val->name) selected  @endif>{{ $val->role }}&nbsp;{{ $val->name }}</option>
                                            @endif
                                        @endforeach
                                     </select>
                                      
                                   @endif

                                   </p>
                                   <p class="pointer">⬇</p>
                                   <p>関与者5：

                                   @if($index->auth_5 !== $index->name && $cnt === 0)
                                      @foreach($get_role as $val)
                                          @if($val->name === $index->auth_5)
                                            {{ $val->role }}
                                          @endif
                                      @endforeach
                                      {{ $index->auth_5 }}
                                      <input type="hidden" name="auth_5" value="{{ $index->auth_5 }}">
                                   @else
                                     <select name="auth_5" class="auth_select" id="auth_5">
                                       @if($cnt >= 1)
                                         <option>---</option>
                                       @endif
                                         @foreach($data as $val)
                                            @if($val->name === $index->auth_5 && empty(old('auth_5')))
                                              <option value="{{ $val->name }}" selected>{{ $val->role }}&nbsp;{{ $val->name }}</option>
                                            @else
                                              <option value="{{ $val->name }}" @if(old('auth_5') === $val->name) selected  @endif>{{ $val->role }}&nbsp;{{ $val->name }}</option>
                                            @endif
                                         @endforeach
                                     </select>
                                    @endif

                                   </p>
                                
                                </div>
                                <div id="comment" class="tab-pane">
                                    <p name="explanation" class="explanation_box">{{ $index->comment }}</p>
                                </div>
                            </div>

                            <button class="btn submit" name="submit" value="submit_1">差戻者へ提出</button>
                            <button class="btn re_submit_btn submit" name="submit" value="submit_2">再提出</button>
                            <!-- <a class="btn discard_btn bg-danger" href="/deleteTask/{{ $index->retrieved_task }}">破棄</a> -->
                            <a class="btn discard_btn margin_btn bg-danger" href="{{ route('deleteTask', ['id'=>$index->retrieved_task] ) }}">破棄</a>
                        </form>
                      </div>
                      <a class="modification_back_btn" href="{{ route('retrieve') }}">戻る</a>

            </div>
        </div>
    </div>
</div>
@endsection
