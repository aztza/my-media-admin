@extends('admin.layout.app')

@section('content')
<div class="row mt-4">
    <div class="col-8 offset-3 mt-5">
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <legend class="text-center">Change Password</legend>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <form class="form-horizontal" action="{{ route("change#password") }}" method="post">
                    @csrf
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="oldPass" class="form-control" id="inputName" placeholder="Enter your old password">
                    @error("oldPass")
                      <span class="text-danger">{{ $message}}</span>
                    @enderror
                    @if (Session::has("fail")) <span class="text-danger">{{ Session::get("fail")}}</span> @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="newPass" class="form-control" id="inputEmail" placeholder="Enter your new password">
                    @error("newPass")
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Comfirm Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="comfirmPass" class="form-control" id="inputEmail" placeholder="Enter comfirm password">
                      @error("comfirmPass")
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn bg-dark text-white">Change Password</button>
                    </div>
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
@endsection
