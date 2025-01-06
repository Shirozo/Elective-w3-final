@extends('index')

@section('navbar-content')
    <div class="topics">
        <a href="{{ route('index') }}" class="topic">W3 Clone</a>
        <div class="topic-loop">
            @foreach ($topics as $t)
                <a href="{{ route('t_show') }}?id={{ $t->id }}" class="topic">{{ $t->name }}</a>
            @endforeach
        </div>
        <a href="{{ route('topic.show') }}" class="topic" style="float: right">Add Topic</a>
    </div>
@endsection

@section('main')
    <div class="landing-content">
        <div class="main-landing">
            <h1>Elective Requirement: Laravel</h1>
            <div class="topic-links">
                @foreach ($topics as $t)
                    <a href="{{ route('t_show') }}?id={{ $t->id }}" class="topic-btn">{{ $t->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
