@extends('index')

@section('navbar-content')
    <div class="topics">
        <b>Admin Panel</b>
    </div>
@endsection

@section('sidenav-content')
    <div class="topic-content">
        <a href="#" class="content-title custom-topic">
            <h3>Topics</h3>
        </a>
    </div>
@endsection

@section('main')
    <div class="table-header">
        <h1>Topics</h1>
        <button onclick="addnew()">Add New</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th style="width: 40%">Action</th>
            </tr>
            @csrf
        </thead>
        <tbody>
            @foreach ($topic as $t)
                <tr>
                    <td>{{ $t->name }}</td>
                    <td>
                        <button class="option-button">View</button>
                        <button class="option-button delete">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function addnew() {
            let title = prompt("Please enter the title");
            if (title) {
                fetch(`{{ route('topic.store') }}?name=${title}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert(data.message);

                        location.reload();
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });
            } else {
                alert("Title is required!")
            }
        }
    </script>
@endsection
