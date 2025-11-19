<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Job;
use Illuminate\Support\Facades\Storage;

// php artisan make:controller JobController --resource, auto creates crud-functions
class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $title = 'Available Jobs';
        $jobs = Job::all();

        return view('jobs.index', compact('title', 'jobs')); // ->with('title', $title);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job): View
    {
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job): View
    {
        $options = ['Full-time', 'Part-time', 'Voluntary', 'Temporary'];
        return view('jobs.edit', compact('job', 'options'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job): RedirectResponse
    {

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
//        dd($request->file('company_logo'));

        $validated = $this->getArr($request);

        if ($request->hasFile('company_logo')) {
            $validated['company_logo'] = $request->file('company_logo')->store('logos', 'public');
        }

        $validated['user_id'] = 1;
        Job::create($validated);
        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $options = ['Full-time', 'Part-time', 'Voluntary', 'Temporary'];
        return view('jobs.create', compact('options'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job): RedirectResponse
    {
        if (!empty($job->company_logo)) {
            Storage::delete('public/logos' . $job->company_logo);
        }
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}
