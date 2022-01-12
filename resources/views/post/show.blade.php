@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header d-flex justify-content-between">
                        <h4>{{ $post->title }}</h4>
                        <h5>{{ $post->category->title }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="">
                            Owner->    {{ $post->user->name }}
                            <br>

                        </div>
                        {{ $post->description }}
                        <br>

                        <div class="border rounded p-3 d-flex overflow-scroll">
                            @forelse($post->photos as $photo)
                                <div class="position-relative me-1">
                                    <a class="venobox" data-gall="img{{ $post->id }}" href="{{ asset('storage/photo/'.$photo->name) }}">
                                        <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" height="100" class="rounded-3" alt="image alt"/>
                                    </a>
                                </div>
                            @empty
                                <p class="text-muted">No Photo</p>
                            @endforelse
                        </div>
                        <hr>
                        <div class="">
                            <a href="{{ route('post.create') }}" class="btn btn-primary">
                                Create Post
                            </a>
                            <a href="{{ route('post.index') }}" class="btn btn-outline-primary">
                                All Post
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
