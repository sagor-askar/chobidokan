<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Project;
use App\Models\ProjectSubmit;
use App\Models\Subscription;
use App\Models\Upload;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function projectList()
    {
        $projectsQuery = Project::with(['user', 'order', 'subscription'])
            ->withCount([
                'projectSubmits as total_designer' => function ($query) {
                    $query->select(\DB::raw('COUNT(DISTINCT user_id)'));
                },
                'uploads as total_submitted_design'
            ])
            ->orderBy('id', 'desc');
        $projects = $projectsQuery->paginate(10);
        return view('admin.project.project-list', compact('projects'));
    }

    public function projectDetails($id)
    {
        $designers = ProjectSubmit::where('project_id', $id)
            ->with(['user', 'uploads'])
            ->get()
            ->unique('user_id')
            ->values();
        return view('admin.project.project-details', compact('designers'));

    }

    public function designerSubmitDetails($projectId, $designerId)
    {

        $designerSubmitfiles = Upload::with(['project','projectSubmit'])->whereHas('projectSubmit', function ($query) use ($projectId, $designerId) {
                                $query->where('project_id', $projectId)
                                      ->where('user_id', $designerId);
                                       })
                                ->get();
        return view('admin.project.submit-design-show', compact('designerSubmitfiles'));

    }


    public function projectDelete($id)
    {
        $project = Project::find($id);
        if ($project->project_file && file_exists(public_path($project->project_file))) {
            unlink(public_path($project->project_file));
        }
        $project->delete();
        return redirect()->route('admin.project.list')->with('success', 'Project deleted successfully.');
    }

}
