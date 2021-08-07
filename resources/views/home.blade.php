@extends('layouts.app')

{{--
    Bladeの考え方。
    @extends で親ビューの機能を継承すると宣言
    @section〜@endsection で自分固有のパーツをつける   
--}}

{{-- Bootstrapのグリッドシステム
・画面の横を12分割していくつ領域を使うかを指定する
・sm, md, lg, xlひとまずmd(PC用)を使っておけばベター

--}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav>
            <ul class="nav flex-column">
                <li class="nav-item">item1</li>
                <li class="nav-item">item2</li>
            </ul>
        </nav>
        <div class="col-md-8">
            {{--
                cardはどこから来た？

                extends('layouts.app') で views/layouts/app.blade.php を読み込む
                    -> asset('js/app.js') で js/app.js を読み込む
                    -> require('./bootstrap'); で Bootstrap を読み込む
                
                    Bootstrapで定義（現在は5.0.2がインストールされている）
            --}}
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{--　__(hogehoge)はヘルパ関数。中身を展開する --}}
                    {{ __('You are logged in!') }}
                </div>
            </div>

            <div class="card">
                <div class="card-header">ログイン情報</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Key</th>
                                <th scope="col">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>ID</td><td>{{$user_id}}</td></tr>
                            <tr><td>名前</td><td>{{ __($user->name) }}</td></tr>
                            <tr><td>メールアドレス</td><td>{{ __($user->email) }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">テキスト入力テスト</div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="testCommentTextarea">コメントテキストエリア</label>
                            <textarea class="form-control" id="testCommentTextarea" rows="3">{{$profile->comment}}</textarea>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="app">
    <example-component></example-component>
    <card-component></card-component>
</div>
@endsection
