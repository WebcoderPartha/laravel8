@extends('admin.admin-master')
@section('admin_content_area')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
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
                        <div class="card-header"><b>Home About Content</b> <a href="{{ route('admin.home.create') }}" class="btn btn-success" style="float: right">Add</a></div>
                        <div class="card-body">
                            @if(count($homeAbout) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Short Description</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($homeAbout as $about)
                                    <tr>
                                        <td>{{ $about->title }}</td>
                                        <td>{{ $about->short_desc }}</td>
                                        <td>{{ $about->description }}</td>
                                        <td><a href="{{ route('admin.about.edit', $about->id) }}" class="btn btn-info">Edit</a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h4 class="text-center text-info">No data found</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
