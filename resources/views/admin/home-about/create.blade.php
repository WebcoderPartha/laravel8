@extends('admin.admin-master')
@section('admin_content_area')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">Add</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.home.store') }}">
                                @csrf @method('POST')
                                <div class="mb-3 form-group">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" id="title">
                                    @error('title')
                                    <span class="text-danger"><small><b>{{ $message }}</b></small></span>
                                    @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="short_desc" class="form-label">Short Description</label>
                                    <textarea name="short_desc" id="short_desc" cols="20" rows="5" class="form-control"></textarea>
                                    @error('short_desc')
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
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
