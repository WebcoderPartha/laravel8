<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Category
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
                        <div class="card-header"><b>Category List</b></div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
{{--                                @php $i = 1; @endphp--}}
                                @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->user->name }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>
                                            <a href="{{ route('edit.category',$category->id) }}" class="btn btn-primary">Edit</a>
                                            <a href="{{ route('delete.category', $category->id) }}" class="btn btn-danger">Trash</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">Add Category</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('category.store') }}">
                                @csrf @method('POST')
                                <div class="mb-3 form-group">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" id="category_name" aria-describedby="emailHelp">
                                    @error('category_name')
                                        <span class="text-danger"><small><b>{{ $message }}</b></small></span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header"><b>Trashed List</b></div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
{{--                                @php $i = 1; @endphp--}}

                                    @foreach($trashed as $trash)
                                        <tr>
                                            <th scope="row">{{ $trashed->firstItem() + $loop->index }}</th>
                                            <td>{{ $trash->category_name }}</td>
                                            <td>{{ $trash->user->name }}</td>
                                            <td>{{ $trash->created_at }}</td>
                                            <td>
                                                <a href="{{ route('restore.category',$trash->id) }}" class="btn btn-primary">Restore</a>
                                                <a href="{{ route('permanent.delete', $trash->id) }}" class="btn btn-danger">Permanent Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $trashed->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
