@extends('index')

@section('navbar-content')
    <div class="topics">
        <a href="{{ route('index') }}" class="topic">W3 Clone</a>
        @foreach ($topic as $t)
            <a href="{{ route('t_show', ['id' => $t->id]) }}" class="topic">{{ $t->name }}</a>
        @endforeach
    </div>
@endsection

@section('sidenav-content')
    <nav class="custom-sidenav">
       {!! $sidenav !!}
    </nav>
@endsection

@section('main')
    @if ($content_main)
        <h1>{{ $content_main->title }}</h1>
        @if ($previousContent)
            <a href="{{ route('t_show') }}?id={{ $t_id }}&c_id={{ $previousContent->id }}"
                class="btn btn-success">Previous</a>
        @endif

        @if ($nextContent)
            <a href="{{ route('t_show') }}?id={{ $t_id }}&c_id={{ $nextContent->id }}"
                class="btn btn-flat btn-success" style="float: right">Next</a>
        @endif

        @if ($content_main->youtube_link1 || $content_main->youtube_link2)
            <h3 style="margin-top: 40px">Check out this Video Below!</h3>
            <div class="video-container">
                @if ($content_main->youtube_link1)
                    <iframe src="{{ $content_main->youtube_link1 }}" frameborder="0" width="420"
                        height="245"></iframe>
                @endif

                @if ($content_main->youtube_link2)
                    <iframe src="{{ $content_main->youtube_link2 }}" frameborder="0" width="420"
                        height="245"></iframe>
                @endif
            </div>
        @endif

        <div class="content-data">
            <h5>Discussion:</h5>
            <p>
                {!! $content_main->content !!}
            </p>
        </div>
    @else
        <div class="content-main">
            <h1>Start Learning {{ $main_topic->name }} Now!</h1>
            <p>Click a topic you want to lear in the left navigation!</p>
        </div>
    @endif
@endsection
