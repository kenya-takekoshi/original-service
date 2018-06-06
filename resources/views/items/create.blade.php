@extends('layouts.app')

@section('content')
    <div class="search">
        <div class="row">
            <div class="text-center">
                {!! Form::open(['route' => 'items.create', 'method' => 'get', 'class' => 'form-inline']) !!}
                    <div class="form-group">
                        {!! Form::text('keyword', $keyword, ['class' => 'form-control input-lg', 'placeholder' => 'タイトル名・アーティスト名・キーワード等を入力', 'size' => 45]) !!}
                    </div>
                    {!! Form::submit('音楽を検索', ['class' => 'btn btn-primary btn-lg']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @include('items.items', ['items' => $items])
@endsection