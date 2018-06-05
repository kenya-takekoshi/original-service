@extends('layouts.app')

@section('cover')
    <div class="cover">
        <div class="cover-inner">
            <div class="cover-contents">
                <h1>素敵な音楽と出会う空間</h1>
                @if (!Auth::check())
                    <a href="{{ route('signup.get') }}" class="btn btn-success btn-lg">Music Boxを始める</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('content')
    テスト
@endsection