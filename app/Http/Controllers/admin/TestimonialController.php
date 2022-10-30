<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Testimonial;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('card.view')) {
			abort(403, 'Unauthorized action.');
		}

		return view('admin.testimonial.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = Testimonial::where('name', '!=', config('system.default_role.admin'))->orderBy('id', 'DESC')->get();
            
			return Datatables::of($document)
                ->editColumn('rating', function ($model) {
                    $position = '<img style="width:50px;" src="'. asset('storage/home-page-content/'. $model->rating) .'" alt="Icon">';
                    return $position;
                })
				->addIndexColumn()
				->addColumn('action', function ($model) {
					return view('admin.testimonial.action', compact('model'));
				})->rawColumns(['action', 'rating'])->make(true);
		}
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('card.create')) {
			abort(403, 'Unauthorized action.');
		}

        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => ['required', 'max:255']
        ]);

        if($request->hasFile('rating')) {
            $storagePath = $request->file('rating')->store('public/home-page-content/');
            $rating = basename($storagePath);
        }

        if($request->hasFile('picture')) {
            $storagePath = $request->file('picture')->store('public/home-page-content/');
            $picture = basename($storagePath);
        }

        $model = new Testimonial;
        $model->rating = $rating;
        $model->name = $request->name;
        $model->designation = $request->designation;
        $model->content = $request->content;
        $model->picture = $picture;
        $model->video_url = $request->video_url;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'goto' => route('admin.testimonial.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('card.update')) {
            abort(403, 'Unauthorized action.');
        }

        // find the data
        $model = Testimonial::findOrFail($id);

        // return
        return view('admin.testimonial.edit', compact('model'));
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
        $validator = $request->validate([
            'name' => ['required', 'max:255']
        ]);

        $model = Testimonial::findOrFail($id);
        $model->name = $request->name;
        $model->designation = $request->designation;
        $model->content = $request->content;
        $model->video_url = $request->video_url;

        if($request->hasFile('rating')) {
            $storagePath = $request->file('rating')->store('public/home-page-content/');
            $rating = basename($storagePath);
            $model->rating = $rating;
        }

        if($request->hasFile('picture')) {
            $storagePath = $request->file('picture')->store('public/home-page-content/');
            $picture = basename($storagePath);
            $model->picture = $picture;
        }

        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Testimonial Updated'), 'goto' => route('admin.testimonial.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Testimonial::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
