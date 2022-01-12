@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        Post List
                    </div>
                    <div class="card-body">

                        <div class="mb-3 d-flex justify-content-between">

                            <div class="">
                                <a href="{{ route('post.create') }}" class="btn btn-primary">
                                    Create Post
                                </a>
                                @isset(request()->search)
                                    <a href="{{ route('post.index') }}" class="btn btn-outline-primary mr-3">
                                        <i class="feather-list"></i>
                                        All Post
                                    </a>
                                    <span>Search By : " {{ request()->search }} "</span>
                                @endisset
                            </div>
                            <form method="get" class="w-25">
                                <div class="input-group ">
                                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search Something">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-fw"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <table class="table table-hover align-middle">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="w-25">Title</th>
                                <th>Photo</th>
                                <th>Is Publish</th>
                                <th>Category</th>
                                <th>Owner</th>
                                <th>Control</th>
                                <th>Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td class="small">{{ Str::words($post->title,10) }}</td>
                                    <td>
                                        @forelse($post->photos()->latest('id')->limit(3)->get() as $photo)
                                            <a class="venobox" data-gall="img{{ $post->id }}" href="{{ asset('storage/photo/'.$photo->name) }}">
                                                    <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" class="list-thumbnail" height="40" alt="image alt"/>
                                            </a>

                                        @empty
                                            <p class="text-muted">No Photo</p>
                                        @endforelse
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" {{ $post->is_publish ? 'checked':'' }}>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">
                                                {{ $post->is_publish ? 'Publish' : 'Unpublish' }}
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $post->category->title ?? "Unknown Category" }}</td>
                                    <td>
                                        {{ $post->user->name ?? "Unknown User" }}
                                    </td>
                                    <td>

                                        <div class="btn-group">
                                            <a href="{{ route('post.show',$post->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-info-circle fa-fw"></i>
                                            </a>
                                            <a href="{{ route('post.edit',$post->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-pencil-alt fa-fw"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-primary" form="postDeleteFrom{{ $post->id }}">
                                                <i class="fas fa-trash-alt fa-fw"></i>
                                            </button>
                                        </div>

                                        <form action="{{ route('post.destroy',$post->id) }}" id="postDeleteFrom{{ $post->id }}" class="d-inline-block" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>

                                    </td>
                                    <td>
                                        <p class="small mb-0">
                                            <i class="fas fa-calendar"></i>
                                            {{ $post->created_at->format("Y-m-d") }}
                                        </p>
                                        <p class="mb-0 small">
                                            <i class="fas fa-clock"></i>
                                            {{ $post->created_at->format("H:i a") }}
                                        </p>



                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8" class="text-center">There is no Post</td>
                                </tr>

                            @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            {{ $posts->appends(request()->all())->links() }}
                            <p class="font-weight-bold mb-0 h4">Total : {{ $posts->total() }}</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
