@extends('layouts.app')

@section('content')
<div>
    <form class="form-inline" method="POST" action="{{ route('book.search') }}">
        @csrf
        <input type="text" name="bookTitle">
        <button type="submit" class="btn btn-primary">検索</button>
    </form>
</div>
<p>Book index content.</p>
<div>
    @isset($title)
        <p>検索ワード「{{ $title }}」</p>
    @endisset

    @isset($result)
        <p>{{ $result }}</p>
    @endisset
</div>
@endsection