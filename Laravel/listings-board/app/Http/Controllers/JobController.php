<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $title = 'Available Jobs';
        $jobs = ['Web Developer', 'Web Designer', 'Front-End Developer', 'Back-End Developer', 'Android Developer'];
        $jobs2 = [];
        return view('jobs.index', compact('title', 'jobs', 'jobs2')); // ->with('title', $title);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(string $id)
    {
        return "Showing job $id";
    }

    public function store(Request $request)
    {
        $title = $request->input('title');
        $info = $request->input('info');

        return "Job: $title - Info: $info";
    }
}
