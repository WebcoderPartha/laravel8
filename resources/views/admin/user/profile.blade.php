@extends('admin.admin-master')
@section('admin_content_area')

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2>Profile Edit</h2>
                </div>
{{--                    @if(session('success'))--}}
{{--                        <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--                            <strong>{{ session('success') }}</strong>--}}
{{--                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                <div class="card-body">
                    <form class="form-pill" method="POST" action="{{ route('update.profile') }}" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" id="name" placeholder="Enter name">
                            @error('name')
                                <span class="text-danger"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" id="email" placeholder="Enter email">
                            @error('email')
                            <span class="text-danger"><small>{{ $message }}</small></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="profile_photo_path">Profile Photo</label>
                            <input type="file" class="form-control-file" name="profile_photo_path" id="profile_photo_path">
                            @error('profile_photo_path')
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
