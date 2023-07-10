@extends('admin.layout.app')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>Trending Posts</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap text-center">
                <thead>
                  <tr>
                    <th>Post ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>View Count</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $p)
                        <tr>
                        <td>{{ $p->post_id }}</td>
                        <td>{{ $p->title}}</td>
                        <td>{{ $p->description}}</td>
                        <td>
                            <img width="70px" class="rounded shadow-sm" @if($p->image == null) src="{{ asset("image/default.jpg") }}" @else src="{{ asset("image/".$p->image) }} @endif" alt="image">
                        </td>
                        <td>{{ $p->post_count }}</td>
                        <td>
                            <a href="{{ route("trendPost#detail",$p->post_id) }}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                        </td>
                        </tr>
                    @endforeach
                  </tbody>
              </table>
              <div class="d-flex justify-content-end mr-2 mt-2">
                {{-- <div>{{ $posts->links() }}</div> --}}
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>
@endsection

