<?php
namespace App\Http\Controllers;

use App\Models\JobOffer;
use App\Models\JobRequest;
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    // Display a listing of the job offers
    public function index()
    {
        $jobOffers = JobOffer::all();
        return view('hr.job_offersi', compact('jobOffers'));
    }

    // Show the form for creating a new job offer
    public function create()
    {
        return view('hr.job_offerse');
    }

    // Store a newly created job offer in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'salary' => 'required|numeric|min:0',
        ]);

        JobOffer::create($request->all());
        return redirect()->route('job_offers.index')->with('success', 'Job Offer created successfully.');
    }
    public function show()
    {
        // Fetch all job offers from the database
        $jobOffers = JobOffer::all();

        return view('job_offers', compact('jobOffers')); // Pass the job offers to the view
    }



    // Show the form for editing the specified job offer
    public function edit(JobOffer $jobOffer)
    {
        return view('hr.job_offerst', compact('jobOffer'));
    }

    // Update the specified job offer in storage
    public function update(Request $request, JobOffer $jobOffer)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'salary' => 'required|numeric|min:0',
        ]);

        $jobOffer->update($request->all());
        return redirect()->route('job_offers.index')->with('success', 'Job Offer updated successfully.');
    }

    // Remove the specified job offer from storage
    public function destroy(JobOffer $jobOffer)
    {
        $jobOffer->delete();
        return redirect()->route('job_offers.index')->with('success', 'Job Offer deleted successfully.');
    }
    public function apply(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cover_letter' => 'required|string|max:2000',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048', // Validate the resume file
        ]);

        // Store the resume file and get its path
        $resumePath = $request->file('resume')->store('resumes'); // Store in the 'resumes' directory

        // Create a new job application
        JobRequest::create([
            'user_id' => auth()->id(), // Assuming the user is authenticated
            'job_offer_id' => $id,
            'cover_letter' => $request->cover_letter,
            'resume_path' => $resumePath, // Add the resume path to the database
        ]);

        return redirect()->back()->with('success', 'Your application has been submitted successfully!');
    }


}
