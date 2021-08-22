@extends('layouts.app')

@section('content')
<div id="app">
    <div class="container">
        <div class="row justify-content-center">
            <nav class="col-md-2 sidebar">
                <div class="list-group">
                    <a href="{{ route('home') }}" class="list-group-item list-group-item-action">Home</a>
                    <a href="{{ route('note') }}" class="list-group-item list-group-item-action">Note</a>
                </div>
            </nav>
            <div class="col-md-8">
                <div class="list-group">
                @foreach ($notes as $note)
                    <a href="{{ route('note.show', ['note_id' => $note->id]) }}" class="list-group-item list-group-item-action">{{$note->title}}</a>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection