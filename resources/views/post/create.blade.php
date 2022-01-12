@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 justify-content-center">

                <div class="card">

                    <div class="card-header">
                        Create Category
                    </div>
                    <div class="card-body">

                        <form action="{{ route('post.store') }}" class="mb-3" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row align-items-end">
                                <div class="mb-3">
                                    <label class="form-label">Post Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title">
                                    @error('title')
                                    <p class="text-danger small">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Select Category</label>
                                    <select class="form-select @error('category') is-invalid @enderror" name="category">
                                        @foreach(\App\Models\Category::all() as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == old('category') ? 'selected' : '' }}>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <p class="text-danger small">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Photo</label>
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror" value="{{ old('photo') }}" name="photo[]" multiple>
                                    @error('photo')
                                    <p class="text-danger small">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Post description</label>
                                    <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }} </textarea>
                                    @error('description')
                                    <p class="text-danger small">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" required>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Confirm</label>
                                    </div>
                                    <button class="btn btn-lg btn-primary">Create Post</button>

                                </div>
                            </div>
                            @error('title')
                            <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection

