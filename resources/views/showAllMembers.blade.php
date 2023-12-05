<!DOCTYPE html>
<html lang="en">
<head>
  <title>GymMaster Solutions</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      background-color: #f8f9fa;
    }

    .navbar {
      background-color: #343a40;
      color: #ffffff;
    }

    .jumbotron {
      background-color: #007bff;
      color: #fff;
      padding: 2rem;
      margin-bottom: 0;
    }

    .btn-primary {
      background-color: #28a745;
      border-color: #28a745;
    }

    .list-group-item {
      cursor: pointer;
    }

    .table th, .table td {
      text-align: center;
    }

    #myModal {
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: #fff;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Our Fitness Family</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/trainer') }}">Trainer</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/member') }}">Member</a>
            </li>
        </ul>
    </div>
</nav>

<div class="jumbotron text-center">
  <h1>Membership</h1>
  <div class="float-right mr-5">
    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New Member</button>
  </div>
</div>
  
<div class="container">
  <div class="row">
    <div class="col-3">
      <div class="list-group">
        <a href="{{ url('/trainer') }}" class="list-group-item list-group-item-action">Trainer</a>
        <a href="{{ url('/member') }}" class="list-group-item list-group-item-action active">Member</a>
      </div>
    </div>

    <div class="col-9">
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>Id</th>
            <th>Member Name</th>
            <th>Member Phone</th>
            <th>Trainer id</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach($member as $m)
            <tr>
              <td>{{ $m->id }}</td>
              <td>{{ $m->Member_Name }}</td>
              <td>{{ $m->Member_Phone }}</td>
              <td>{{ $m->trainer_id }}</td>
              <td><a href="javascript:void(0)" class="btn btn-warning editBtn">Edit</a></td>
              <td>
                <form action="{{ url('member', $m->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Member</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ url('member') }}" method="POST" id="form">
          @csrf
          <div class="form-group">
            <label for="Member_Name">Member Name</label>
            <input type="text" id="Member_Name" name="Member_Name" class="form-control">
          </div>
          <div class="form-group">
            <label for="Member_Phone">Member Phone</label>
            <input type="text" id="Member_Phone" name="Member_Phone" class="form-control">
          </div>
          <div class="form-group">
            <label for="trainer_id">Trainer id</label>
            <select name="trainer_id" id="trainer_id" class="form-control">
              <option value="" selected disabled>Select Trainer</option>
              @foreach($trainer as $tr)
                <option value="{{ $tr->id }}">{{ $tr->Trainer_Name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <input type="submit" id="submit" name="submit" class="btn btn-success">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $('.editBtn').click(function(e){
    trainer_id = e.target.parentElement.previousElementSibling.innerText;
    Member_Phone = e.target.parentElement.previousElementSibling.previousElementSibling.innerText;
    Member_Name = e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.innerText;
    id= e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;

    $('#Member_Name').val(Member_Name);
    $('#Member_Phone').val(Member_Phone);
    $('#trainer_id').val(trainer_id);
    $('#form').attr('action','member/'+id);
    $('#form').append("<input type='hidden' name='_method' value='PUT'>");
    $('#myModal').modal('show');
  })
</script>

</body>
</html>