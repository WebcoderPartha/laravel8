<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Brand
        </h2>
    </x-slot>

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
                        <div class="card-header"><b>Gallery List</b></div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($galleries as $gallery)
                                    <div class="col-md-3 mb-4">
                                        <img src="{{ $gallery->gallery }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">Add Gallery</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 form-group">
                                    <label for="gallery" class="form-label">Brand Image</label>
                                    <input type="file" name="gallery[]" class="form-control" multiple="" id="gallery">
                                    @error('gallery')
                                    <span class="text-danger"><small><b>{{ $message }}</b></small></span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Gallery</button>
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
</x-app-layout>
