@extends('admin.layout.app')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row mt-4">
        <div class="col-5">
            <form action="{{ route("create#category") }}" method="POST">
                @csrf
                <div class="card p-2">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="categoryName" class="form-control" aria-describedby="emailHelp" placeholder="Enter your category name">
                        @error("categoryName")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea type="password" name="categoryDescription" cols="30" rows="10" class="form-control" placeholder="Enter your description"></textarea>
                        @error("categoryDescription")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-primary col-3">Create</button>
                </div>
            </form>
        </div>
        <div class="col-7">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>Category Page</h3>
              <div class="card-tools">
                <form action="{{ route("search#category") }}" method="POST">
                @csrf
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="cateogrySearchKey" class="form-control float-right" placeholder="Search" value="{{ request("cateogrySearchKey") }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                @if (Session::has("delete success"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get("delete success") }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
              <table class="table table-hover text-nowrap text-center">
                <thead>
                  <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Category Description</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($category as $c)
                    <tr>
                        <td>{{$c->category_id}}</td>
                        <td>{{$c->title}}</td>
                        <td>{{$c->description}}</td>
                        <td>
                        <a href="{{ route("updatePage#category",$c->category_id) }}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                        <a href="{{ route("delete#category",$c->category_id)}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
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
