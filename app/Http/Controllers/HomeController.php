<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Certificate;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data admin pertama (asumsi sebagai pemilik portofolio)
        $user = User::first();
        $projects = Project::latest()->get();
        $certificates = Certificate::latest()->get();
        $activities = Activity::latest()->get();

        return view('welcome', compact('user', 'projects', 'certificates', 'activities'));
    }
}
