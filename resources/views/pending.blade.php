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
                             <th>登録日</th>
                             <th>依頼者</th>
                             <th>次の承認者</th>
                             <th>承認</th>
                             <th>差し戻し</th>
                           </tr>
                       </thead>
                       <tbody>
                            @if(!empty($index))
                                @foreach($index as $val)
                                <tr>
                                    <td><a href="/detail/{{$val[0]->id}}">{{ $val[0]->title }}</a></td>
                                    <td>{{ date('y.n.j', strtotime($val[0]->created_at)) }}</td>
                                    <td>{{ $val[0]->name }}</td>
                                    <td>
                                        @if($val[0]->next_person === Auth::User()->name || $val[0]->next_person === NULL)
                                          ---
                                        @else
                                          {{ $val[0]->next_person }}
                                        @endif
                                    </td>
                                    <td><a href="/pending/{{$val[0]->id}}" class="approve">承認</a></td>
                                    <td><a href="/retrieveSenderIndex/{{$val[0]->id}}">差し戻し</a></td>
                                </tr>
                                @endforeach
                            @else
                              案件はありません
                            @endif
                       </tbody>
                   </table>
               </div>

            </div>
        </div>
    </div>
</div>
@endsection
