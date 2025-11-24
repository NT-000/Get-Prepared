<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Job;
use App\Models\Applicant;

// php artisan make:controller JobController --resource, auto creates crud-functions
class JobController extends Controller
{

    use AuthorizesRequests;

    // show all jobs
    // GET /jobs
    public function index(): View
    {
        $title = 'Available Jobs';
        $jobs = Job::latest()->paginate(8); //Job::all();

        return view('jobs.index', compact('title', 'jobs')); // ->with('title', $title);
    }


    // show one single job
    // GET jobs/{$id}
    public function show(Job $job): View
    {
        $hasApplied = false;
        if (auth()->check()) {
            $hasApplied = Applicant::where('job_id', $job->id)
                ->where('user_id', auth()->id())
                ->exists();
        }

        return view('jobs.show', compact('job', 'hasApplied'));
    }

    //edit single
    //GET /jobs/{$id}/edit
    public function edit(Job $job): View
    {
        //check igf user is authorized
        $this->authorize('update', $job);
        $options = ['Full-time', 'Part-time', 'Voluntary', 'Temporary'];
        return view('jobs.edit', compact('job', 'options'));
    }

    //update job listing
    // PUT /jobs/{$id}
    public function update(Request $request, Job $job): RedirectResponse
    {
        //check igf user is authorized
        $this->authorize('update', $job);

//        dd($request->file('company_logo'));

        $validated = $this->getArr($request);

        if ($request->hasFile('company_logo')) {
            Storage::delete('public/logos' . basename($job->company_logo));
            $validated['company_logo'] = $request->file('company_logo')->store('logos', 'public');
        }

        $job->update($validated);
        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');

    }

    /**
     * @param Request $request
     * @return array
     */
    public function getArr(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'zipcode' => 'nullable|string|max:10',
            'country' => 'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|min:8|max:20',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_website' => 'nullable|url',
        ]);

        $validated['remote'] = (bool)(int)$validated['remote'];
        return $validated;
    }

    // save job to db
    // POST /jobs
    public function store(Request $request): RedirectResponse
    {
//        dd($request->file('company_logo'));

        $validated = $this->getArr($request);

        if ($request->hasFile('company_logo')) {
            $validated['company_logo'] = $request->file('company_logo')->store('logos', 'public');
        }

        $validated['user_id'] = Auth::user()->id;
        Job::create($validated);
        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    // show create job form
    // GET jobs/create
    public function create(): View
    {
        $options = ['Full-time', 'Part-time', 'Voluntary', 'Temporary'];
        return view('jobs.create', compact('options'));
    }

    //delete single job
    // DELETE /jobs/{$id}
    public function destroy(Job $job): RedirectResponse
    {
        //check igf user is authorized
        $this->authorize('delete', $job);
        if (!empty($job->company_logo)) {
            Storage::delete('public/logos' . $job->company_logo);
        }
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}
