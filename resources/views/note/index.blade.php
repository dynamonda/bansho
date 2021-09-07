@extends('layouts.app')

@section('content')

<note-list-component :user_id={{ $user_id }}></note-list-component>

@endsection