<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>Laravel CRUD</title>
</head>
<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card rounded-3">
                        <div class="card-body p-4">
                            <h4 class="text-center my-3 pb-3">To Do App</h4>
                            <!--Start Add To Do Item-->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ url('/todos') }}" method="POST" class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2">
                                @csrf
                                <div class="col-12">
                                    <div class="form-outline">
                                        <input type="text" id="form1" name="task" class="form-control" placeholder="Enter Your Task Here.." />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            <!--End Add To Do Item-->




                            <!--Start To Do Item List-->
                            <table class="table mb-4">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Todo item</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($todos as $todo)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{ $todo->task }}</td>
                                            <td>{{ $todo->status == 1 ? 'In Progress' : 'Completed' }}</td>
                                            <td>
                                                @if($todo->status == 1)
                                                    <button type="button" class="btn btn-success approve_task" data-id="{{ $todo->id }}"><i class="fa fa-check"></i></button>
                                                @endif
                                                <button type="button" class="btn btn-primary edit_task" data-id="{{ $todo->id }}"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger delete_task" data-id="{{ $todo->id }}" type="submit"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ url('todos/update') }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text" name="task" id="edit_task">
                                                <input type="hidden" name="id" id="id">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="Submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/fontawesome.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $('.approve_task').on('click', function(){
            let id = $(this).attr('data-id');
            $.ajax({
                url: "{{url('/')}}/approve_task/"+id,
                type: 'GET',
                success: function(res) {
                    location.reload();
                }
            });
        });


        $('.delete_task').on('click', function(){
            let id = $(this).attr('data-id');
            $.ajax({
                url: "{{url('/')}}/delete_task/"+id,
                type: 'GET',
                success: function(res) {
                    location.reload();
                }
            });
        });


        $('.edit_task').on('click', function(){
            let id = $(this).attr('data-id');
            $.ajax({
                url: "{{url('/')}}/edit_task/"+id,
                type: 'GET',
                success: function(res) {
                    $('#exampleModal').modal('show');
                    $('#id').val(res.id);
                    $('#edit_task').val(res.task);

                }
            });
        });



        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('message') }}");
        @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.warning("{{ session('warning') }}");
        @endif

    </script>
</body>

</html>
