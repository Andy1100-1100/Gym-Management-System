<!DOCTYPE html>
<html lang="en">
<head>
  <title>GymMaster Solutions</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
  <style>
    body {
        padding-top: 20px;
    }

    .jumbotron {
        margin-bottom: 0;
    }

    .list-group-item {
        cursor: pointer;
    }

    .editBtn {
        cursor: pointer;
    }

    .text-danger {
        color: #dc3545;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Unleash Your Potential: Meet Our Trainers</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/trainer">Trainer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/member">Member</a>
            </li>
        </ul>
    </div>
</nav>

<div class="jumbotron text-center bg-primary text-white">
    <h1>Trainers</h1>
    <div class="float-right mr-5">
        <button class="btn btn-light" data-toggle="modal" data-target="#myModal" data-toggle="tooltip" title="Add New Trainer">
            <i class="fas fa-plus"></i> Add New Trainer
        </button>
    </div>
</div>
  
<div class="container">

    <div class="row">
        <div class="col-2">
            <div class="list-group">
                <a href="/trainer" class="list-group-item list-group-item-action">Trainer</a>
                <a href="/member" class="list-group-item list-group-item-action">Member</a>
            </div>
        </div>

        <div class="col-10">
            <table class="table table-striped" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Trainer Name</th>
                        <th>Trainer Batch</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trainer as $t)
                    <tr>
                        <td>{{$t->id}}</td>
                        <td>{{$t->Trainer_Name}}</td>
                        <td>{{$t->Trainer_Batch}}</td>
                        <td><a href="javascript:void(0)" class="btn btn-warning editBtn" data-toggle="tooltip" title="Edit">Edit</a></td>
                        <td>
                            <form action="trainer/{{$t->id}}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Trainer</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="trainer" method="POST" id="form" onsubmit="return validateForm()">
                    @csrf
                    <div class="form-group">
                        <label for="Trainer_Name">Trainer Name</label>
                        <input type="text" id="Trainer_Name" name="Trainer_Name" class="form-control">
                        <span id="nameError" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="Trainer_Batch">Trainer Batch</label>
                        <input type="text" id="Trainer_Batch" name="Trainer_Batch" class="form-control">
                        <span id="batchError" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function validateForm() {
        var name = document.getElementById("Trainer_Name").value;
        var batch = document.getElementById("Trainer_Batch").value;

        // Reset error messages
        document.getElementById("nameError").innerHTML = "";
        document.getElementById("batchError").innerHTML = "";

        // Basic validation
        if (name.trim() === "") {
            document.getElementById("nameError").innerHTML = "Trainer Name is required.";
            return false;
        }

        if (batch.trim() === "") {
            document.getElementById("batchError").innerHTML = "Trainer Batch is required.";
            return false;
        }

        // Additional validation rules can be added as needed

        return true; // Submit the form if validation passes
    }

    $(document).ready(function() {
        // Initialize DataTables for sorting and pagination
        $('#dataTable').DataTable();

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Handle delete confirmation with SweetAlert
        $('form.delete-form').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        });

        // Handle modal for editing
        $('.editBtn').click(function(e){
            batch = e.target.parentElement.previousElementSibling.innerText;
            name = e.target.parentElement.previousElementSibling.previousElementSibling.innerText;
            id = e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.innerText;

            $('#Trainer_Name').val(name);
            $('#Trainer_Batch').val(batch);
            $('#form').attr('action','trainer/'+id);
            $('#form').append("<input type='hidden' name='_method' value='PUT'>");

            $('#myModal').modal('show');
        });
    });
</script>

</body>
</html>