<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Project;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ProjectSubmit;
use App\Models\Upload;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function projectStore(Request $request)
    {
        $subscription = Subscription::find($request->subscription_id);

        $data = $request->all();
        $data['user_id'] =  Auth::user()->id;
        $data['status'] =  1;
        $data['publish_date'] =Carbon::now()->format('Y-m-d');
        $data['expire_date'] = Carbon::now()->addDays($subscription->days)->format('Y-m-d');

        $project = Project::create($data);

        if ($request->hasFile('project_file')) {
            $file = $request->file('project_file');
            $fileName = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/project/' . $fileName;
            $file->move(public_path('uploads/project'), $fileName);
            $project->project_file = $filePath;
        }
        $project->save();



        Order::create([
            'project_id' => $project->id,
            'user_id' => Auth::user()->id,
            'subscription_id' => $subscription->id,
            'amount' => $subscription->price,
        ]);

        return redirect()->route('welcome')->with('success', 'Successfully Post Submitted!');
    }


    public function customizationDetail($id)
    {
        $project = Project::with(['user','order', 'subscription','projectSubmits','uploads'])->where('id', $id)->first();
        return view('frontend.menu.customizeDetails',compact('project'));
    }

    // customize job submission
    public function submission($id)
    {
        $project = Project::with(['user','order', 'subscription'])->where('id', $id)->first();
        return view('frontend.menu.submission',compact('project'));
    }

    public function submit(Request $request,$id)
    {
        $request->validate(
            [
                'design_file.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:15360',
                'title' => 'required|string|max:255',
            ],
            [
                'design_file.*.max'   => 'Each file must be less than 15 MB.',
                'design_file.*.mimes' => 'Only JPG, JPEG, PNG, GIF formats are allowed.',
                'design_file.*.image' => 'File must be a valid image.',
            ]
        );


        try {
            DB::beginTransaction();

        $projectSubmit = ProjectSubmit::create([
            'project_id' => $id,
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'visibility' => $request->visibility,
            'stock' => $request->stock,
            'submit_date' =>Carbon::now()->format('Y-m-d'),
        ]);

        if ($request->hasFile('design_file')) {
            foreach ($request->file('design_file') as $file) {
                $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $path = public_path('uploads/project/submit-file/'.$filename);

                $img = Image::make($file->getRealPath());
                $img->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path, 90);

                Upload::create([
                    'file_path' => 'uploads/project/submit-file/'.$filename,
                    'file_name' => $filename,
                    'file_type' => $file->getClientMimeType(),
                    'project_id' => $id,
                    'project_submit_id' => $projectSubmit->id,
                ]);
            }
        }
            DB::commit();
        return back()->with('success', 'Project submitted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Submission failed: ' . $e->getMessage());
        }
    }


}
