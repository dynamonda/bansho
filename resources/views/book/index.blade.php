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
        <p>検索結果：{{ $result->count }}</p>
        <div class="list-group">
        @foreach ($result->Items as $item)
            {{-- <a href="#" --}}
            <div class="list-group-item list-group-item-action">
                <h5 class="mb-1">{{ $item->Item->title }}</h5>
                <small>{{ $item->Item->author }}</small>
                <div class="btn-group float-end">
                    <button type="button" class="btn btn-primary" onclick="sendSave({{ $item->Item->isbn }})">保存</button>
                </div>
            </div>
            {{-- </a> --}}
        @endforeach
        </div>

        <div>
            <p>{{ json_encode($result, JSON_UNESCAPED_UNICODE) }}</p>
        </div>
    @endisset
</div>
@endsection