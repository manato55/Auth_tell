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
               <div class="table_container">
                   <table>
                       <thead>
                           <tr>
                               <th>件名</th>
                               <th>依頼中</th>
                               <th>登録日</th>
                               <th>引戻し</th>
                           </tr>
                       </thead>
                       <tbody>
                           @if(!empty($index))
                             @foreach($index as $val)
                                <tr>
                                    <td><a href="/detail/{{$val->id}}">{{ $val->title }}</a></td>
                                    <td>{{ $val->name }}</td>
                                    <td>{{ date('y.n.j', strtotime($val->created_at)) }}</td>
                                    <td><a href="/retrieve/{{$val->id}}" class="self_retrieve">引戻す</a></td>
                                </tr>
                             @endforeach
                           @else
                             依頼済み案件はありません
                           @endif
                       </tbody>
                   </table>
               </div>

            </div>
        </div>
    </div>
</div>
@endsection
