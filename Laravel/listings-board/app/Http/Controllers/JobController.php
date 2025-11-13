<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Job;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        Job::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);
        return redirect()->route('jobs.index');
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
     * Display the specified resource.
     */
    public function show(Job $job): View
    {
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): string
    {
        return "Editing job $id";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): string
    {
        return "Updating job $id";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): string
    {
        return "Deleting job $id";
    }
}
