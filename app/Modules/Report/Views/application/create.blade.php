@extends('layouts.application')

@section('title'){{ getTitle($extra->name) }}@endsection


@section('content')
    <h3><img class="img-responsive user-thumbnail" src="{{ url($extra->picture) }}">  {{ $extra->name }}</h3>
    {!! form($form) !!}
@endsection
