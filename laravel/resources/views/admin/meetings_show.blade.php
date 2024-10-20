@include('layout.dsaha')

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <main>
        <p><strong>Subject:</strong> {{ $meeting->subject }}</p>
        <p><strong>Meeting Date:</strong> {{ $meeting->meeting_date }}</p>
        <p><strong>Location:</strong> {{ $meeting->location }}</p>
        <p><strong>Organizer:</strong> {{ $meeting->organizer->name }}</p>
        <p><strong>Manager:</strong> {{ $meeting->manager ? $meeting->manager->name : 'N/A' }}</p>
        <a href="{{ route('meetings.index') }}">Back to List</a>
    </main>
</div>
</div>
</div>
</div>

</div>
@include('layout.Footer')
