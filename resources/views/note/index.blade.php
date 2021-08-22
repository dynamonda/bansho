@extends('layouts.app')

@section('content')
<div class="list-group">
@foreach ($notes as $note)
    <a href="{{ route('note.show', ['note_id' => $note->id]) }}" class="list-group-item list-group-item-action">{{$note->title}}</a>
@endforeach
@endsection