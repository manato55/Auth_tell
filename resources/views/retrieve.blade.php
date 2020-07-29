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
                               <th>返却者</th>
                               <th>返却日</th>
                           </tr>
                       </thead>
                       <tbody>
                           
                             @forelse($index as $val)
                                <tr>
                                    <td><a href="/task_modification/{{$val->id}}">{{ $val->title }}</a></td>
                                    <td>{{ $val->name }}</td>
                                    <td>{{ date('y.n.j', strtotime($val->updated_at)) }}</td>
                                </tr>
                             @empty
                               返却案件はありません
                             @endforelse
                       </tbody>
                   </table>
               </div>

            </div>
        </div>
    </div>
</div>
@endsection
