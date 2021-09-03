<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Category
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">Update Category</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('update.category',$category->id) }}">
                                    @csrf @method('PUT')
                                    <div class="mb-3 form-group">
                                        <label for="category_name" class="form-label">Category Name</label>
                                        <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}" id="category_name" aria-describedby="emailHelp">
                                        @error('category_name')
                                        <span class="text-danger"><small><b>{{ $message }}</b></small></span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
