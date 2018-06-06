<header>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-left" href="/"><img src="{{ secure_asset("images/logo.png") }}" alt="Monolist"></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        <li>
                            <a href="{{ route('items.create') }}">
                                <span class="glyphicon glyphicon-music" aria-hidden="true"></span>
                                音楽を追加
                            </a>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="gravatar">
                                    <img src="{{ Gravatar::src(Auth::user()->email, 20) . '&d=mm' }}" alt="" class="img-circle">
                                </span>
                                {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">
                                         <span class="glyphicon glyphicon-headphones" aria-hidden="true"></span>
                                        マイページ
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ route('logout.get') }}">
                                        <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                                        ログアウト
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('signup.get') }}">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                新規登録
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}">
                                <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
                                ログイン
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>