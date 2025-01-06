@extends('index')

@section('navbar-content')
    <div class="topics">
        <b>Admin Panel</b>
    </div>
@endsection

@section('main')
    <a class="btn btn-flat btn-success" href="{{ route('content.show') }}?q={{ $topic }}">Back</a>
    <div class="table-header">
        <h1>Sub Contents</h1>
        <button onclick="addnew()" class="btn btn-flat btn-sm">Add New</button>
    </div>
    <table id="topicTable">
        <thead>
            <tr>
                <th style="width: 2%" style="text-align: center">No.</th>
                <th>Name</th>
                <th style="width: 40%">Action</th>
            </tr>
            @csrf
        </thead>
        <?php
            $c = 1; 
        ?>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td style="text-align: center">{{ $c }}</td>
                    <td>{{ $d->title }}</td>
                    <td>
                        <button class="option-button"
                            onclick="updateThis('{{ $d->id }}')">Update</button>
                        <button class="option-button delete" onclick="deleteThis('{{ $d->id }}')">Delete</button>
                    </td>
                </tr>
                <?php
                $c += 1; 
            ?>
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
                    url: "{{ route('subcontent.store') }}",
                    data: {
                        title: $("#title").val(),
                        youtube_link1: $("#v1").val(),
                        youtube_link2: $("#v2").val(),
                        content: $("#content").val(),
                        id: $("#id").val(),
                        t_id: "{{ $topic }}",
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
                    url: "{{ route('subcontent.delete') }}",
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
                    url: "{{ route('subcontent.update') }}",
                    data: {
                        title: $("#update_title").val(),
                        youtube_link1: $("#update_v1").val(),
                        youtube_link2: $("#update_v2").val(),
                        content: $("#update_content").val(),
                        id: $("#update_id").val(),
                        t_id: "{{ $topic }}",
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
                url: "{{ route('subcontent.api') }}",
                data: {
                    id: id
                },
                success: function(response) {
                    $("#update_title").val(response.data.title),
                    $("#update_v1").val(response.data.youtube_link1),
                    $("#update_v2").val(response.data.youtube_link2),
                    $("#update_content").val(response.data.content)
                }
            })
            $('#updateModal').modal("show")
        }
    </script>
@endsection

@section('modal')
    <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" method="POST" action="{{ route('topic.store') }}" id="addTopic">
                <div class="modal-header">
                    <h5 class="modal-title">Add Subcontent</h5>
                    <button type="button" class="close" onclick="$('#addModal').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" name="id" id="id" value="{{ $content }}">
                <div class="modal-body">
                    <div class="form-group has-feedback">
                        <label for="title">Title:</label>
                        <input type="text" required placeholder="Title" id="title" name="title"
                            class="form-control">
                    </div>
                    <div class="form-group has-feedback">
                        <label for="v1">Video Link 1:</label>
                        <input type="url" placeholder="Source" id="v1" name="v1"
                            class="form-control">
                    </div>
                    <div class="form-group has-feedback">
                        <label for="v2">Video Link 2:</label>
                        <input type="url" placeholder="Source" id="v2" name="v2"
                            class="form-control">
                    </div>
                    <div class="form-group has-feedback">
                        <label for="content">Content:</label>
                        <textarea required placeholder="Content" id="content" name="content"
                            class="form-control">
                        </textarea>
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
        <div class="modal-dialog modal-lg" role="document">
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
                    <div class="form-group has-feedback">
                        <label for="update_v1">Video Link 1:</label>
                        <input type="url" placeholder="Source" id="update_v1" name="update_v1"
                            class="form-control">
                    </div>
                    <div class="form-group has-feedback">
                        <label for="update_v2">Video Link 2:</label>
                        <input type="url" placeholder="Source" id="update_v2" name="update_v2"
                            class="form-control">
                    </div>
                    <div class="form-group has-feedback">
                        <label for="update_content">Content:</label>
                        <textarea required placeholder="Content" id="update_content" name="update_content"
                            class="form-control">
                        </textarea>
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
