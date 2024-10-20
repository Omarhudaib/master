@include('layout.dsaha')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Manage Posts</h2>

                <!-- Card for managing positions -->
                <div class="card shadow-sm p-4">

                        <div class="container">
                            <div class="container">
                                <h1>{{ $post->title }}</h1>

                                <p><strong>Created by:</strong> {{ $post->user->name }} on {{ $post->created_at->format('F j, Y') }}</p>

                                <div class="mb-3">
                                    <h4>Content</h4>
                                    <p>{{ $post->content }}</p>
                                </div>

                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Edit Post</a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete Post</button>
                                </form>
                                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
                            </div>
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
