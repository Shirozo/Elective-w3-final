@extends('index')

@section('navbar-content')
    <div class="topics">
        <b style="width:100px !important;"><a href="{{ route('index') }}" class="topic">W3 Clone</a></b>
    </div>
@endsection

@section('main')
    <div class="table-header">
        <h1>Topics</h1>
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
            @foreach ($topic as $t)
                <tr>
                    <td>{{ $t->name }}</td>
                    <td>
                        <a class="btn option-button" style="color: white" href="{{ route('content.show') }}?q={{ $t->id }}">View</a>
                        <button class="btn option-button" onclick="updateThis('{{ $t->id }}', '{{ $t->name }}')">Update</button>
                        <button class="btn option-button delete" onclick="deleteThis('{{ $t->id }}')">Delete</button>
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
                    url: "{{ route('topic.store') }}",
                    data: {
                        name: $("#topic").val(),
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            title: "Success!",
                            text: "Topic Added!",
                            icon: "success"
                        }).then(() => {
                            window.location.reload();
                        });;
                    },
                    error: function(err) {
                        swal({
                            title: "Error",
                            text: errr.responseJSON.message,
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
                    url: "{{ route('topic.delete') }}",
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
                        swal({
                            title: "Error",
                            text: errr.responseJSON.message,
                            icon: "error",
                            button: "Close"
                        })
                    }
                })
            })

            $("#updateTopic").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "PUT",
                    url: "{{ route('topic.update') }}",
                    data: {
                        update_id: $("#update_id").val(),
                        name: $("#up_topic").val(),
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
                        swal({
                            title: "Error",
                            text: errr.responseJSON.message,
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


        function updateThis(id, name) {
            $('#updateModal').modal("show")
            $("#update_id").val(id)
            $("#up_topic").val(name)
        }
    </script>
@endsection

@section('modal')
    <div class="modal fade" id="addModal">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="POST" action="{{ route('topic.store') }}" id="addTopic">
                <div class="modal-header">
                    <h5 class="modal-title">Add Topic</h5>
                    <button type="button" class="close" onclick="$('#addModal').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="topic">Topic:</label>
                    <input type="text" required placeholder="Topic Name" id="topic" name="topic"
                        class="form-control">
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
                    <h4>ARE YOU SURE YOU WANT TO DELETE THIS TOPIC?</h4>
                    <input type="hidden" id="delete_id" name="delete_id" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="button" class="btn btn-secondary" onclick="$('#deleteModal').modal('hide')">Close</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="updateModal">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="POST" action="{{ route('topic.update') }}" id="updateTopic">
                <div class="modal-header">
                    <h5 class="modal-title">Update Topic</h5>
                    <button type="button" class="close" onclick="$('#updateModal').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="topic">Topic:</label>
                    <input type="hidden" id="update_id" name="update_id" class="form-control">
                    <input type="text" required placeholder="Topic Name" id="up_topic" name="up_topic"
                        class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" onclick="$('#updateModal').modal('hide')">Close</button>
                </div>
            </form>
        </div>
    </div>
@endsection
