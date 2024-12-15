@extends('index')

@section('navbar-content')
    <div class="topics">
        @foreach ($topic as $t)
            <a href="{{ route('t_show') }}?id={{ $t->id }}" class="topic">{{ $t->name }}</a>
        @endforeach
    </div>
@endsection

@section('main')
    <div class="landing-content">
        <h1>Elective Requirement: Laravel</h1>
        <div class="topic-links">
            @foreach ($topic as $t)
                <a href="{{ route('t_show') }}?id={{ $t->id }}" class="topic">{{ $t->name }}</a>
            @endforeach
        </div>
    </div>
@endsection
