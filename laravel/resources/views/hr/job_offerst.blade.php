@include('layout.dsahh')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12">
    <h2 class="text-center mb-4">Edit Job Offer</h2>
    <form action="{{ route('job_offers.update', $jobOffer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $jobOffer->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required>{{ $jobOffer->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="company">Company</label>
            <input type="text" name="company" class="form-control" value="{{ $jobOffer->company }}" required>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" class="form-control" value="{{ $jobOffer->location }}" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" class="form-control" value="{{ $jobOffer->type }}" required>
        </div>
        <div class="form-group">
            <label for="salary">Salary</label>
            <input type="number" name="salary" class="form-control" step="0.01" value="{{ $jobOffer->salary }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</form>
</div>
</div>
</div>
@include('layout.Footer')
