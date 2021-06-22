@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">
            EDIT POST:
            {{-- <a href="{{ route('admin.posts.show'), $post->id }}">{{ $post->title}}</a> --}}
        </h1>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                {{-- VALIDATION --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error )
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.posts.update', $post->id)}}" method="post">
                    @csrf
                    @method('PATCH')

                    {{-- TITLE --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror" {{-- se errore applica la classe bootstrap "is-invalid" --}}
                            id="title"
                            name="title"
                            value="{{ $post->title }}"
                        >
                        {{-- Print text errore --}}
                        @error('title')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- CONTENT --}}
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea
                            class="form-control @error('content') is-invalid @enderror" {{-- se errore applica la classe bootstrap "is-invalid" --}}
                            name="content"
                            id="content"
                            row="6">{{ $post->content }}
                        </textarea>
                        {{-- Print text errore --}}
                        @error('content')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Edit post</button>
                </form>
            </div>
        </div>
    </div>
@endsection
