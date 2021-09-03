@extends('admin.admin-master')
@section('admin_content_area')

    <div class="py-12">
        <div class="container">
            <div class="row">

                    <div class="col-md-8 m-auto">
                        <div class="card">
                            <div class="card-header">Update Brand</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('update.brand', $brand->id) }}" enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="mb-3 form-group">
                                        <label for="brand_name" class="form-label">Brand Name</label>
                                        <input type="text" name="brand_name" class="form-control" value="{{ $brand->brand_name }}" id="brand_name">
                                        @error('brand_name')
                                        <span class="text-danger"><small><b>{{ $message }}</b></small></span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 form-group">
                                        <img src="{{ asset($brand->brand_image) }}" style="width: 80px; height: 100%">
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="brand_image" class="form-label">Brand Image</label>
                                        <input type="file" name="brand_image" class="form-control" id="brand_image">
                                        @error('brand_name')
                                        <span class="text-danger"><small><b>{{ $message }}</b></small></span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Brand</button>
                                </form>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection
