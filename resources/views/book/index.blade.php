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
    @isset($books)
        <p>{{ $books }}</p>
    @endisset
</div>
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
                    @if ($item->is_have)
                        {{-- これガッツリデータ読めちゃうけどいいのかな？ --}}
                        <button id="book-botton-{{ $item->Item->isbn }}" type="button" class="btn btn-primary" onclick="sendSave({{ json_encode($item->Item) }})">保存</button>
                    @else
                        <button id="book-botton-{{ $item->Item->isbn }}" type="button" class="btn btn-outline-primary" onclick="sendSave({{ json_encode($item->Item) }})">保存</button>
                    @endif
                </div>
            </div>
            {{-- </a> --}}
        @endforeach
        </div>
        <div class="btn-toolbar">
            <div class="btn-group me-2">
                @for ($i = 0; $i < $result->pageCount; $i++)
                    <a href="{{ route('book.search.page', ['bookTitle'=>$title, 'page'=>$i+1]) }}" class="btn btn-outline-primary">{{ $i + 1 }}</a>
                @endfor
            </div>
        </div>

        <div>
            <p>{{ json_encode($result, JSON_UNESCAPED_UNICODE) }}</p>
        </div>
    @endisset
</div>
@endsection