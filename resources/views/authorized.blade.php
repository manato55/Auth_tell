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
                             <th>決定日</th>
                             <th>削除</th>
                           </tr>
                       </thead>
                       <tbody>
                            @forelse($index as $val)
                            <tr>
                                <td><a href="/detail/{{$val->id}}">{{ $val->title }}</a></td>
                                <td>{{ date('y.n.j', strtotime($val->updated_at)) }}</td>
                                <td><a class="discard_btn" href="/detail/delete/{{$val->id}}">削除</a></td>
                            </tr>
                            @empty
                              決定済み案件はありません
                            @endforelse
                       </tbody>
                   </table>
               </div>

            </div>
        </div>
    </div>
</div>
@endsection
