<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function projectStore(Request $request)
    {
        $data = $request->all();
        $data['user_id'] =  Auth::user()->id;
        $data['status'] =  1;
        $data['publish_date'] =Carbon::now()->format('Y-m-d');

        $project = Project::create($data);

        if ($request->hasFile('project_file')) {
            $file = $request->file('project_file');
            $fileName = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/project/' . $fileName;
            $file->move(public_path('uploads/project'), $fileName);
            $project->project_file = $filePath;
        }
        $project->save();
        return redirect()->route('welcome')->with('success', 'Successfully Submitted!');
    }
}
