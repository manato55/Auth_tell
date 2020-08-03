@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">アカウント設定</div>

                <div class="panel-body">
                <p class="msg">{{ session('msg') }}</p>
                    <form class="form-horizontal" method="POST" action="{{ route('changeAccount') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">氏名</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $var_name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $var_email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dep') ? ' has-error' : '' }}">
                            <label for="dep" class="col-md-4 control-label">部・所</label>

                            <div class="col-md-6">
                                <input id="dep" type="text" class="form-control" name="dep" value="{{ $var_dep }}" required>

                                @if ($errors->has('dep'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dep') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sec') ? ' has-error' : '' }}">
                            <label for="sec" class="col-md-4 control-label">課</label>

                            <div class="col-md-6">
                                <input id="sec" type="text" class="form-control" name="sec" value="{{ $var_sec }}" required>

                                @if ($errors->has('sec'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sec') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('team') ? ' has-error' : '' }}">
                            <label for="team" class="col-md-4 control-label">担当</label>

                            <div class="col-md-6">
                                <input id="team" type="text" class="form-control" name="team" value="{{ $var_team }}" required>

                                @if ($errors->has('team'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('team') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('rola') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label">役職</label>

                            <div class="col-md-6">
                                <input id="role" type="text" class="form-control" name="role" value="{{ $var_role }}" required>

                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    登録
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
