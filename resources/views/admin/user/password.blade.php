@extends('admin.admin-master')
@section('admin_content_area')

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card card-default">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card-header card-header-border-bottom">
                    <h2>Change Password</h2>

                </div>
                <div class="card-body">
                    <form class="form-pill" method="POST" action="{{ route('update.password') }}">
                        @csrf @method('POST')
                        <div class="form-group">
                            <label for="oldpassword">Old Password</label>
                            <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Enter old password">
                            @error('oldpassword')
                                <span class="text-danger"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter new password">
                            @error('password')
                            <span class="text-danger"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Enter confirmation password">
                            @error('password_confirmation')
                            <span class="text-danger"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                        <div class="form-footer pt-4 pt-5 mt-4 border-top">
                            <button type="submit" class="btn btn-primary btn-default">Update</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
