@extends('index')

@section('navbar-content')
    <div class="topics">
        <b>Admin Panel</b>
    </div>
@endsection

@section('main')
    <a class="btn btn-flat btn-success" href="{{ route('topic.show') }}">Back</a>
    <div class="table-header">
        <h1>Contents</h1>
        <button onclick="addnew()" class="btn btn-flat btn-sm">Add New</button>
    </div>
    <table id="topicTable">
        <thead>
            <tr>
                <th>Name</th>
                <th style="width: 40%">Action</th>
            </tr>
            @csrf
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $d->title }}</td>
                    <td>
                        <a href="{{ route('subcontent.show', ['topic' => $id, 'content' => $d->id]) }}" class="option-button btn-sm delete subcontent">Subcontent</a>
                        <button class="option-button btn-sm" onclick="updateThis('{{ $d->id }}')">Update</button>
                        <button class="option-button btn-sm delete"
                            onclick="deleteThis('{{ $d->id }}')">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $("#topicTable").dataTable()

            $("#addTopic").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('content.store') }}",
                    data: {
                        title: $("#title").val(),
                        id: $("#id").val(),
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            title: "Success!",
                            text: "Content Added!",
                            icon: "success"
                        }).then(() => {
                            window.location.reload();
                        });;
                    },
                    error: function(err) {
                        swal({
                            title: "Error",
                            text: err.responseJSON.message,
                            icon: "error",
                            button: "Close"
                        })
                    }
                })
            })

            $("#deleteTopic").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('content.delete') }}",
                    data: {
                        delete_id: $("#delete_id").val(),
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            title: "Success!",
                            text: "Topic Deleted!",
                            icon: "success"
                        }).then(() => {
                            window.location.reload();
                        })
                    },
                    error: function(err) {
                        Swal.fire({
                            title: "Error",
                            text: errr.responseJSON.message,
                            icon: "error",
                            button: "Close"
                        })
                    }
                })
            })

            $("#updateContent").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "PUT",
                    url: "{{ route('content.update') }}",
                    data: {
                        title: $("#update_title").val(),
                        id: $("#update_id").val(),
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            title: "Success!",
                            text: "Topic Updated!",
                            icon: "success"
                        }).then(() => {
                            window.location.reload();
                        })
                    },
                    error: function(err) {
                        Swal.fire({
                            title: "Error",
                            text: err.responseJSON.message,
                            icon: "error",
                            button: "Close"
                        })
                    }
                })
            })
        })

        function addnew() {
            $('#addModal').modal("show")
        }

        function deleteThis(id) {
            $('#deleteModal').modal("show")
            $("#delete_id").val(id)
        }


        function updateThis(id) {
            $("#update_id").val(id)
            $.ajax({
                type: "GET",
                url: "{{ route('content.api') }}",
                data: {
                    id: id
                },
                success: function(response) {
                    $("#update_title").val(response.data.title)
                }
            })
            $('#updateModal').modal("show")
        }
    </script>
@endsection

@section('modal')
    <div class="modal fade" id="addModal">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="POST" action="{{ route('topic.store') }}" id="addTopic">
                <div class="modal-header">
                    <h5 class="modal-title">Add Content</h5>
                    <button type="button" class="close" onclick="$('#addModal').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" name="id" id="id" value="{{ $id }}">
                <div class="modal-body">
                    <div class="form-group has-feedback">
                        <label for="title">Title:</label>
                        <input type="text" required placeholder="Title" id="title" name="title"
                            class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" onclick="$('#addModal').modal('hide')">Close</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="POST" action="{{ route('topic.delete') }}" id="deleteTopic">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Topic</h5>
                    <button type="button" class="close" onclick="$('#deleteModal').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>ARE YOU SURE YOU WANT TO DELETE THIS CONTENT?</h4>
                    <input type="hidden" id="delete_id" name="delete_id" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="button" class="btn btn-secondary"
                        onclick="$('#deleteModal').modal('hide')">Close</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="updateModal">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="POST" action="{{ route('topic.update') }}" id="updateContent">
                <div class="modal-header">
                    <h5 class="modal-title">Update Topic</h5>
                    <button type="button" class="close" onclick="$('#updateModal').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="update_id" id="update_id">
                    <div class="form-group has-feedback">
                        <label for="update_title">Title:</label>
                        <input type="text" required placeholder="Title" id="update_title" name="update_title"
                            class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary"
                        onclick="$('#updateModal').modal('hide')">Close</button>
                </div>
            </form>
        </div>
    </div>
@endsection
