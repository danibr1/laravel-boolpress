@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">CREATE NEW POST</h1>

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

                <form action="{{ route('admin.posts.store')}}" method="post">
                    @csrf
                    @method('POST')

                    {{-- TITLE --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror" {{-- se errore applica la classe bootstrap "is-invalid" --}}
                            id="title"
                            name="title"
                            value="{{ old('title') }}" placeholder="Titolo"
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
                            row="6"
                            placeholder="Content">{{ old('content') }}
                        </textarea>
                        {{-- Print text errore --}}
                        @error('content')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- CATEGORIES --}}
                    <div class="mb-3">
                        <label for="category_id">Category</label>
                        <select class="form-control @error('category_id') is-invalid @enderror"
                        name="category_id" id="category_id">

                        <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @if ( $category->id == old('category_id')) selected @endif
                                    >
                                    {{ $category->name }}
                                </option>
                            @endforeach


                        </select>
                        @error('category_id')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Create post</button>
                    <a href="{{ route('admin.posts.index')}}">Return to home</a>
                </form>
            </div>
        </div>
    </div>
@endsection
