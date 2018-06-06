@if (Auth::user()->is_favoriting($item->code))
    {!! Form::open(['route' => 'item_user.unfavorite', 'method' => 'delete']) !!}
        {!! Form::hidden('itemCode', $item->code) !!}
        {!! Form::submit('お気に入り解除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => 'item_user.favorite']) !!}
        {!! Form::hidden('itemCode', $item->code) !!}
        {!! Form::submit('お気に入り登録', ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
@endif