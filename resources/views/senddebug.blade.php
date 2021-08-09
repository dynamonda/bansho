@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='card'>
        <div class='card-header'>タイトルです。</div>
        <div class='card-body'>
            <p>本文です。</p>
            <p>{{ $hello }}</p>
        </div>
    </div>
    
    {{-- つぶやき表示 --}}
    <div class='card'>
        <div class='card-header'>みんなのつぶやき</div>
        <div class='card-body'>
            <ul class="list-group">
                @foreach ($tweets as $tweet)
                    <li class="list-group-item">{{ $tweet->comment }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection