
@include('layout.dsah')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="row no-gutters">
                            <!-- Main Content (Removed Sidebar for Messages) -->
                            <div class="col-lg-12 col-xl-12">
                                <div class="chat-box scrollable position-relative" style="height: calc(100vh - 111px);">
                                    <!-- Display the Posts Here -->
                                    <ul class="list-style-none px-3 pt-3">
                                        @foreach($posts as $post)
                                            <li class="mt-3">
                                                <div class="d-inline-block pl-3">
                                                    <h6 class="font-weight-medium">{{ $post->user->name }}</h6>
                                                    <div class="msg p-2 d-inline-block mb-1">{{ $post->content }}</div>
                                                    <div class="chat-time d-block font-10 mt-1">{{ $post->created_at->format('h:i A') }}</div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <!-- Pagination -->
                                    <div class="d-flex justify-content-center">
                                        {{ $posts->links() }}
                                    </div>
                                </div>
                            </div>
                        </div> <!-- row no-gutters -->
                    </div> <!-- card -->
                </div> <!-- col-md-12 -->
            </div> <!-- row -->
        </div> <!-- container-fluid -->
    </div> <!-- page-breadcrumb -->
</div> <!-- page-wrapper -->
@include('layout.Footer')
