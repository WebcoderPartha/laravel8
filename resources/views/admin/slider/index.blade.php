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
                        <div class="card-header"><b>Slider List</b></div>
                        <div class="card-body">
                            @if(count($sliders) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Brand Name</th>
                                        <th scope="col">Brand Image</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{--                                @php $i = 1; @endphp--}}
                                    @foreach($sliders as $slider)
                                        <tr>
                                            <th scope="row">{{ $sliders->firstItem() + $loop->index }}</th>
                                            <td>{{ $slider->title }}</td>
                                            <td><img src="{{ asset($slider->image) }}" alt="" style="width: 60px; height: 100%"></td>
                                            <td>{{ \Str::limit($slider->description, 30) }}</td>
                                            <td>
                                                <a href="{{ route('edit.brand',$slider->id) }}" class="btn btn-primary">Edit</a>
                                                <a href="{{ route('slider.delete', $slider->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $sliders->links() }}
                            @else
                                <h4 class="text-center text-info">No data found</h4>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">Add Slider</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                                @csrf @method('POST')
                                <div class="mb-3 form-group">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" id="title">
                                    @error('title')
                                    <span class="text-danger"><small><b>{{ $message }}</b></small></span>
                                    @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" cols="20" rows="5" class="form-control"></textarea>
                                    @error('description')
                                    <span class="text-danger"><small><b>{{ $message }}</b></small></span>
                                    @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="image" class="form-label"> Slider Image</label>
                                    <input type="file" name="image" class="form-control" id="image">
                                    @error('image')
                                    <span class="text-danger"><small><b>{{ $message }}</b></small></span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Slider</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
