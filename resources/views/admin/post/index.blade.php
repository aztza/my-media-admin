@extends('admin.layout.app')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row mt-4">
        <div class="col-5">
            <form action="{{ route("create#post") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card p-2">
                    <div class="form-group">
                        <label>Post Title</label>
                        <input type="text" name="postTitle" class="form-control" aria-describedby="emailHelp" placeholder="Enter your post title">
                        @error("postTitle")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea type="password" name="postDescription" cols="30" rows="10" class="form-control" placeholder="Enter your description"></textarea>
                        @error("postDescription")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Image</label>
                        <input type="file" name="postImage" class="form-control">
                        @error("postImage")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Category</label>
                        <select name="postCategory" id="" class="form-control">
                            <option value="">Choose your option</option>
                            @foreach ($category as $c)
                                <option value="{{ $c->category_id }}">{{ $c->title }}</option>
                            @endforeach
                        </select>
                        @error("postCategory")
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
              <h3 class="card-title"></h3>Posts</h3>
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
                    <th>Post ID</th>
                    <th>Title</th>
                    <th>Image</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($post as $p)
                    <tr>
                        <td>{{$p->post_id}}</td>
                        <td>{{$p->title}}</td>
                        <td>
                            <img width="70px" class="rounded shadow-sm" @if($p->image == null) src="{{ asset("image/default.jpg") }}" @else src="{{ asset("image/".$p->image) }} @endif" alt="image">
                        </td>
                        <td>
                        <a href="{{ route("updatePage#post",$p->post_id) }}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                        <a href="{{ route("delete#post",$p->post_id)}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
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
