<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    // GET /saved
    public function index(): View
    {
        $savedJobs = auth()->user()->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(9);
        return view('saved.index', compact('savedJobs'));
    }

    // create new saved job
    // POST /saved/{job}
    public function store(Job $job): RedirectResponse
    {
        if (auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with(['error' => 'You have already saved this job.']);
        }
        auth()->user()->bookmarkedJobs()->attach($job->id);
        return back()->with('success', 'Job bookmarked!');
    }

    //delete saved job
    //DELETE /saved/{job}

    public function destroy(Job $job): RedirectResponse
    {
        if (!auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'Could not remove saved job from the list.');
        }
        auth()->user()->bookmarkedJobs()->detach($job->id);

        return back()->with(['success' => 'Successfully removed saved job from list.']);
    }
}
