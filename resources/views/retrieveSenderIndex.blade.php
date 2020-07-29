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
                 <p>件名</p>
                 <p class="detail_general_box">{{ $index->title }}</p>
                   <form action="/toSender/{{$index->id}}" method="POST">
                     {{ csrf_field() }}
                     <p>コメント</p>
                     <textarea name="comment" class="explanation_box"></textarea>
                     <br><button class="btn retrieve">差し戻し</button>
                   </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
