@extends('index')

@section('navbar-content')
    <div class="topics">
        <a href="#" class="topic">JS</a>
        <a href="#" class="topic">CSS</a>
        <a href="#" class="topic">HTML A</a>
    </div>
@endsection

@section('sidenav-content')
    <h2 id="title">Title Here</h2>
    <div class="topic-content">
        <a href="#" class="content-title">A</a>
        <a href="#" class="content-title">B</a>
        <a href="#" class="content-title">C</a>
    </div>
@endsection

@section('main')
    <form action="">
        <div class="form-data">
            <label for="title">Topic Title:</label><br>
            <input type="text" id="title" name="title" class="form-input">
        </div>

        <div class="video-data">
            <div class="video">
                <h3>Videos</h3>
                <iframe width="420" height="315" src="https://www.youtube.com/embed/tgbNymZ7vqY">
                </iframe>
                <label for="source">Video Source</label>
                <input type="text" name="source" id="source">
            </div>
            <div class="video">
                <h3>Videos</h3>
                <iframe width="420" height="315" src="https://www.youtube.com/embed/tgbNymZ7vqY">
                </iframe>
                <label for="source">Video Source</label>
                <input type="text" name="source" id="source">
            </div>
        </div>
        <div class="">
            <h4>Topic Content</h4>
            <textarea class="text-content" name="topic-content" id="topic-content" cols="30" rows="10"></textarea>
        </div>
        <div class="submit">
            <button>Submit</button>
        </div>
    </form>
@endsection
