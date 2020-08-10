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
                <div class="search_container table_container">
                    <p>件名検索</p>
                    <div class="text-right">
                        <select name="search_range" form="search_form" class="range_box">
                            <option @if(isset($selected_range) && $selected_range === 'sec') selected @endif value="sec">課内</option>
                            <option @if(isset($selected_range) && $selected_range === 'team') selected @endif value="team">担当内</option>
                        </select>
                    </div>

                    <form action="{{ route('searchByTitle') }}" method="POST" id="search_form">
                        {{ csrf_field() }}
                        <input type="text" name="search_title" class="title_length title_margin_bottom" @isset($search_title) value="{{ $search_title }}" @endisset>
                        <button class="btn">検索</button>
                    </form>

                    @if(!empty($index) && $index->isEmpty() !== true)
                    　　<table>
                            <thead>
                                <tr>
                                    <th>件名</th>
                                    <th>担当者</th>
                                    <th>登録日</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($index as $val)
                                    <tr>
                                        <td><a href="{{route('detail', ['id'=>$val->id] ) }}">{{ $val->title }}</a></td>
                                        <td>{{ $val->name }}</td>
                                        <td>{{ date('y.n.j', strtotime($val->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @elseif(isset($index) && $index === '' || isset($index) && $index->isEmpty() !== false)
                        該当案件はありません。
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
