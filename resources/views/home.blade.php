@extends('layouts.app')

{{--
    Bladeの考え方。
    @extends で親ビューの機能を継承すると宣言
    @section〜@endsection で自分固有のパーツをつける   
--}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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

            {{--
                cardはどこから来た？

                extends('layouts.app') で views/layouts/app.blade.php を読み込む
                    -> asset('js/app.js') で js/app.js を読み込む
                    -> require('./bootstrap'); で Bootstrap を読み込む
                
                    Bootstrapで定義（現在は5.0.2がインストールされている）
            --}}
            <div class="card">
                <div class="card-header">第二のカードタイトル</div>
                <div class="card-body">
                    {{ __('第二のカード') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
