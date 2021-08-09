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
</div>
@endsection