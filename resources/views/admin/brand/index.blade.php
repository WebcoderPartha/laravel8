@extends('admin.admin-master')
@section('admin_content_area')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('update'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('update') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header"><b>Brand List</b></div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--                                @php $i = 1; @endphp--}}
                                @foreach($brands as $brand)
                                    <tr>
                                        <th scope="row">{{ $brands->firstItem() + $loop->index }}</th>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td><img src="{{ asset($brand->brand_image) }}" alt="" style="width: 60px; height: 100%"></td>
                                        <td>{{ $brand->created_at }}</td>
                                        <td>
                                            <a href="{{ route('edit.brand',$brand->id) }}" class="btn btn-primary">Edit</a>
                                            <a href="{{ route('delete.brand', $brand->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $brands->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">Add Brand</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 form-group">
                                    <label for="brand_name" class="form-label">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="brand_name">
                                    @error('brand_name')
                                    <span class="text-danger"><small><b>{{ $message }}</b></small></span>
                                    @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="brand_image" class="form-label">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="brand_image">
                                    @error('brand_image')
                                    <span class="text-danger"><small><b>{{ $message }}</b></small></span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="row">--}}
{{--                <div class="col-md-7">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-header"><b>Trashed List</b></div>--}}
{{--                        <div class="card-body">--}}
{{--                            <table class="table">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col">SL</th>--}}
{{--                                    <th scope="col">Category Name</th>--}}
{{--                                    <th scope="col">User</th>--}}
{{--                                    <th scope="col">Created At</th>--}}
{{--                                    <th scope="col">Action</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                --}}{{--                                @php $i = 1; @endphp--}}

{{--                                @foreach($trashed as $trash)--}}
{{--                                    <tr>--}}
{{--                                        <th scope="row">{{ $trashed->firstItem() + $loop->index }}</th>--}}
{{--                                        <td>{{ $trash->category_name }}</td>--}}
{{--                                        <td>{{ $trash->user->name }}</td>--}}
{{--                                        <td>{{ $trash->created_at }}</td>--}}
{{--                                        <td>--}}
{{--                                            <a href="{{ route('restore.category',$trash->id) }}" class="btn btn-primary">Restore</a>--}}
{{--                                            <a href="{{ route('permanent.delete', $trash->id) }}" class="btn btn-danger">Permanent Delete</a>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                            {{ $trashed->links() }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
        </div>
    </div>

@endsection
