@include('layout.dsah')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Employee Chat</h2>

                <!-- Card for Chat -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Chat</h4>
                    </div>
                    <div class="card-body" style="display: flex;">

                        <!-- Sidebar for Employees -->
                        <aside style="width: 25%; border-right: 1px solid #ccc; padding-right: 20px;">
                            <h5>Employees</h5>
                            <ul class="list-group">
                                @foreach ($employees as $employee)
                                    <li class="list-group-item">
                                        <a href="{{ route('chate.show', $employee->id) }}">
                                            {{ $employee->first_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>

                        <!-- Main Chat Section -->
                        <main style="width: 75%; padding-left: 20px;">
                            @if (isset($employee))
                                <h5>Chat with {{ $employee->first_name }}</h5>
                                <div id="messages" class="border rounded p-3 mb-4" style="height: 400px; overflow-y: scroll;">
                                    @foreach ($messages as $message)
                                        <div class="mb-2">
                                            <strong>{{ $message->sender->first_name }}:</strong>
                                            <p>{{ $message->body }}</p>
                                        </div>
                                    @endforeach
                                </div>

                                <form action="{{ route('chate.send') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="receiver_id" value="{{ $employee->id }}">
                                    <div class="form-group">
                                        <label for="subject">Subject:</label>
                                        <input type="text" name="subject" id="subject" class="form-control" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="body">Message:</label>
                                        <textarea name="body" id="body" class="form-control" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-3">Send</button>
                                </form>
                            @endif
                        </main>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.Footer')
