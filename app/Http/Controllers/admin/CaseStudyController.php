<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CaseStudy;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class CaseStudyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('case_study.view')) {
			abort(403, 'Unauthorized action.');
		}

		return view('admin.case_study.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = CaseStudy::where('header', '!=', config('system.default_role.admin'))->orderBy('id', 'DESC')->get();
            
			return Datatables::of($document)
                ->editColumn('picture', function ($model) {
                    $position = '<img style="width:50px;" src="'. asset('storage/home-page-content/'. $model->picture) .'" alt="Icon">';
                    return $position;
                })
				->addIndexColumn()
				->addColumn('action', function ($model) {
					return view('admin.case_study.action', compact('model'));
				})->rawColumns(['action', 'picture'])->make(true);
		}
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('case_study.create')) {
			abort(403, 'Unauthorized action.');
		}

        return view('admin.case_study.create');
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
            'header' => ['required', 'max:255']
        ]);

        if($request->hasFile('picture')) {
            $storagePath = $request->file('picture')->store('public/home-page-content/');
            $picture = basename($storagePath);
        }

        $model = new CaseStudy;
        $model->alt_tag = $request->alt_tag;
        $model->title = $request->title;
        $model->link = $request->link;
        $model->open_another_tab = $request->open_another_tab;
        $model->header = $request->header;
        $model->picture = $picture;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Case Study Created')]);
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
        if (!auth()->user()->can('case_study.update')) {
            abort(403, 'Unauthorized action.');
        }

        // find the data
        $model = CaseStudy::findOrFail($id);

        // return
        return view('admin.case_study.edit', compact('model'));
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
            'header' => ['required', 'max:255']
        ]);

        $model = CaseStudy::findOrFail($id);
        $model->alt_tag = $request->alt_tag;
        $model->title = $request->title;
        $model->link = $request->link;
        $model->open_another_tab = $request->open_another_tab;
        $model->header = $request->header;
        if($request->hasFile('picture')) {
            $storagePath = $request->file('picture')->store('public/home-page-content/');
            $picture = basename($storagePath);
            $model->picture = $picture;
        }

        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Case Study Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = CaseStudy::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
