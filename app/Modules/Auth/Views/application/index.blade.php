@extends('layouts.application')

@section('title'){{ getTitle($auth) }}@endsection
@section('description'){{ getDescription($auth) }}@endsection

@section('content')
    @if(count($auth))
        <article class="post">
            <header class="post-header">
                <div class="post-title">
                    <h2>{{ $auth->title }}</h2>
                </div>
            </header>
            <div class="post-excerpt">
                {!! $auth->content !!}
            </div>
            <footer class="post-footer">
                @if(!empty(Config::get('settings')->disqus_shortname))
                    <div id="disqus_thread" class="comments"></div>
                @endif
            </footer>
        </article>
    @endif
@endsection
