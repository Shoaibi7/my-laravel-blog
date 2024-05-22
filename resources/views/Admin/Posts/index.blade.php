@include('layouts.app')

<div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto px-6 py-8">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-lg font-semibold text-gray-700">Posts List</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('post.create') }}" class="btn btn-primary">New Post</a>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $post->title }}</td>
                                <td>
                                    @if ($post->publish == 1)
                                    <span class="badge bg-success">Published</span>
                                    @else
                                    <span class="badge bg-danger">Draft</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</div>
