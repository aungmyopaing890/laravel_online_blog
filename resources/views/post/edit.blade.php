@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

                <div class="card">

                    <div class="card-header">
                        Edit Post
                    </div>
                    <div class="card-body">

                        <form action="{{ route('post.update',$post->id) }}" id="updateForm" method="post">
                            @csrf
                            @method('put')
                        </form>

                        <div class="mb-3">
                            <label class="form-label">Post Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" form="updateForm" value="{{ old('title',$post->title) }}" name="title">
                            @error('title')
                            <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Category</label>
                            <select class="form-select @error('category') is-invalid @enderror" form="updateForm" name="category">
                                @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == old('category',$post->category_id) ? 'selected' : '' }}>{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <div class="border rounded p-3 d-flex overflow-scroll">

                                <form action="{{ route('photo.store') }}" method="post" class="d-none" id="photoUploadForm" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <div class="mb-3">
                                        <label class="form-label">Photo</label>
                                        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photoInput" value="{{ old('photo') }}" name="photo[]" multiple>
                                        @error('photo')
                                        <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary">Upload</button>
                                </form>

                                <div class="border border-2 border-dark  rounded-3 me-1 uploader-ui d-flex justify-content-center align-items-center px-3" id="photoUploadUi">
                                    <i class="fas fa-plus fa-2x"></i>
                                </div>

                                @forelse($post->photos as $photo)
                                    <div class="position-relative me-1">
                                        <form action="{{ route('photo.destroy',$photo->id) }}" class="position-absolute bottom-0 start-0" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        <a class="venobox" data-gall="img{{ $post->id }}" href="{{ asset('storage/photo/'.$photo->name) }}">
                                            <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" height="100" class="rounded-3" alt="image alt"/>
                                        </a>
                                    </div>
                                @empty
                                    <p class="text-muted">No Photo</p>
                                @endforelse
                            </div>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea type="text" rows="10" form="updateForm" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description',$post->description) }}</textarea>
                            @error('description')
                            <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" required>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Confirm</label>
                            </div>
                            <button class="btn btn-lg btn-primary" form="updateForm">Update Post</button>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>

        let photoUploadForm = document.getElementById('photoUploadForm');
        let photoInput = document.getElementById('photoInput');
        let photoUploadUi = document.getElementById('photoUploadUi');

        photoUploadUi.addEventListener('click',function (){
            photoInput.click();
        })

        photoInput.addEventListener('change',function (){
            photoUploadForm.submit();
        })

    </script>


@endsection
