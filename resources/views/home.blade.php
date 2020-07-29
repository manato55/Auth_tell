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
                        <form method="POST" action="/upload" enctype="multipart/form-data">
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
                            </ul>

                            <div class="tab-content">
                                <div id="general" class="tab-pane active">
                                    <p>件名</p>
                                    <input class="title_length" type="text" name="title" value="{{ old('title') }}">
                                    <p>登録日</p>
                                    <input type="date" name="registered_date" value="{{ $var_date }}">
                                </div>
                                <div id="explanation" class="tab-pane">
                                    <textarea name="explanation" class="explanation_box">{{ old('explanation') }}</textarea>
                                </div>
                                <div id="document" class="tab-pane">
                                  <p>依頼文等</p>
                                  <input type="file" id="file" name="file_1" class="form-control file_tag">
                                  <input type="file" id="file" name="file_2" class="form-control file_tag">
                                  <input type="file" id="file" name="file_3" class="form-control file_tag">
                                  <input type="file" id="file" name="file_4" class="form-control file_tag">
                                  <p>参考資料</p>
                                  <input type="file" id="file" name="ref_1" class="form-control file_tag">
                                  <input type="file" id="file" name="ref_2" class="form-control file_tag">
                                  <input type="file" id="file" name="ref_3" class="form-control file_tag">
                                  <input type="file" id="file" name="ref_4" class="form-control file_tag">
                                </div>
                                  <div id="route" class="tab-pane route_box">
                                   <p>担当者：
                                     <span>{{ Auth::User()->name }}</span>
                                   </p>
                                   <p class="pointer">⬇</p>
                                   <p>関与者1
                                     <select name="auth_1" class="auth_select" id="auth_1">
                                        <option>---</option>
                                        @foreach($data as $val)
                                        <option @if(old('auth_1') === $val->name) selected  @endif>{{$val->name}}</option>
                                        @endforeach
                                     </select>
                                   </p>
                                   <p class="pointer">⬇</p>
                                   <p>関与者2
                                     <select name="auth_2" class="auth_select" id="auth_2">
                                       <option>---</option>
                                       @foreach($data as $val)
                                       <option @if(old('auth_2') === $val->name) selected  @endif>{{$val->name}}</option>
                                       @endforeach
                                     </select>
                                   </p>
                                   <p class="pointer">⬇</p>
                                   <p>関与者3
                                     <select name="auth_3" class="auth_select" id="auth_3">
                                       <option>---</option>
                                       @foreach($data as $val)
                                       <option @if(old('auth_3') === $val->name) selected  @endif>{{$val->name}}</option>
                                       @endforeach
                                     </select>
                                   </p>
                                   <p class="pointer">⬇</p>
                                   <p>関与者4
                                     <select name="auth_4" class="auth_select" id="auth_4">
                                       <option>---</option>
                                       @foreach($data as $val)
                                       <option @if(old('auth_4') === $val->name) selected  @endif>{{$val->name}}</option>
                                       @endforeach
                                     </select>
                                   </p>
                                   <p class="pointer">⬇</p>
                                   <p>関与者5
                                     <select name="auth_5" class="auth_select" id="auth_5">
                                       <option>---</option>
                                       @foreach($data as $val)
                                       <option @if(old('auth_5') === $val->name) selected  @endif>{{$val->name}}</option>
                                       @endforeach
                                     </select>
                                   </p>
                                </div>
                            </div>

                            <button class="submit btn">提出</button>
                        </form>
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection
