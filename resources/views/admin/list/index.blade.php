@extends('admin.layout.app')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>Admin List</h3>

              <div class="card-tools">
                <form action="{{ route("admin#search") }}" method="post">
                    @csrf
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="adminSearchKey" value="{{ request("adminSearchKey") }}" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            @if (Session::has("already login"))
                <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
                    {{ Session::get("already login") }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap text-center">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Gender</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($adminList as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td>{{ $admin->address }}</td>
                            <td>{{ $admin->gender }}</td>
                            <td>
                                <a href="{{ route("admin#delete",$admin->id )}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>
@endsection

