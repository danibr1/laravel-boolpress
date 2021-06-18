@extends('layouts.app')

@section('content')

    <div class="container">
        {{-- MESSAGE DELETED POST --}}
        @if (session('deleted'))
            <div class="alert alert-success">
                <strong>{{session('deleted')}} Deleted successfull</strong>
            </div>
        @endif


        <h1>OUR POSTS</h1>

        <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">Create new post</a>

        <table class="table mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th collspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>
                            <a class="btn btn-success"
                            href="{{ route('admin.posts.show', $post->id) }}">SHOW</a>
                        </td>
                        <td>
                             <a class="btn btn-warning"
                            href="{{ route('admin.posts.edit', $post->id) }}">EDIT</a>
                        </td>
                        <td>
                            <form class="delete-post-form" action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <input class="btn btn-danger" type="text" value="DELETE">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>


    </div>
@endsection
