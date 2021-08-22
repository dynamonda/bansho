@extends('layouts.app')

@section('content')
<div class="list-group">
@foreach ($notes as $note)
    @if (!empty($selected_note) && $selected_note->id === $note->id)
    <a href="{{ route('note.show', ['note_id' => $note->id]) }}" class="list-group-item list-group-item-action active">{{$note->title}}</a>
    @else
    <a href="{{ route('note.show', ['note_id' => $note->id]) }}" class="list-group-item list-group-item-action">{{$note->title}}</a>
    @endif
@endforeach
</div>

<editor-component :note_id={{ $selected_note->id }}></editor-component>
@endsection