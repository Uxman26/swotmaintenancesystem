<?php

namespace App\Http\Controllers;

use App\ProjectFile;
use App\Notification;
use App\Models\Package;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\MaintenanceHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public function dashboard() {
        return view('site/dashboard/user_dashboard');
    }

    public function projects() {
        $projects = Project::where('user_id', Auth::user()->id)->get();
        return view('site/project/index', compact('projects'));
    }

    public function project_details($id, Request $request){
        $project = Project::find($id);
        // $projectFiles = ProjectFile::where('project_id', $project->id)->get();
        $package = Package::find($project->package_id);
        $maintenanceHistories = MaintenanceHistory::where('project_id', $project->id)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('site.project.details', [
            'project' => $project,
            // 'projectFiles' => $projectFiles,
            'package' => $package,
            'maintenanceHistories' => $maintenanceHistories
        ]);
    }

    public function login(){
        return view('auth/login');
    }
}
