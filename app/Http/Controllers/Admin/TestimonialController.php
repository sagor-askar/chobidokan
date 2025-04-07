<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonial = Testimonial::all();
        return view('admin.testimonials.index', compact('testimonial'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'speech' => 'required',
            'name'   => 'required|string|max:255',
            'designation' => 'required|string|max:255',
        ]);

        Testimonial::create($request->all());
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $request->validate([
            'speech'  => 'required',
            'name'    => 'required|string|max:255',
            'designation' => 'required|string|max:255',
        ]);

        $testimonial->update($request->all());
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->delete();

            return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial Deleted Successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.testimonials.index')->with('error', 'Failed to delete testimonial: ' . $e->getMessage());
        }
    }

    public function massDestroy(Request $request)
    {
        Testimonial::whereIn('id', $request->ids)->delete();
        return response()->json(['message' => 'Selected Testimonials deleted successfully'], 200);
    }
}
