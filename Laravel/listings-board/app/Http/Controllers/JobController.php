<?php

namespace App\Http\Controllers;

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
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): string
    {
        $title = $request->input('title');
        $info = $request->input('info');

        return "Job: $title - Info: $info";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): string
    {
        return "Showing job $id";
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
