<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Solution;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;


class SolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('solution.view')) {
			abort(403, 'Unauthorized action.');
		}

		return view('admin.solution.index');
    }

    public function datatable(Request $request) {
        if ($request->ajax()) {
            $document = Solution::where('link_name', '!=', config('system.default_role.admin'))->orderBy('id', 'DESC')->get();
            
            return Datatables::of($document)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return view('admin.solution.action', compact('model'));
                })->rawColumns(['action'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('solution.create')) {
			abort(403, 'Unauthorized action.');
		}

        return view('admin.solution.create');
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
            'link_name' => ['required', 'max:255']
        ]);

        // if($request->hasFile('background_picture')) {
        //     $storagePath = $request->file('background_picture')->store('public/home-page-content/');
        //     $background_picture = basename($storagePath);
        // }

        $model = new Solution;
        $model->link_name = $request->link_name;
        $model->title = $request->title;
        // $model->header = $request->header;
        $model->content = $request->content;
        $model->button_text = $request->button_text;
        $model->button_url = $request->button_url;
        $model->open_another_tab = $request->open_another_tab;
        $model->youtube_video = $request->youtube_video;
        // $model->background_picture = $background_picture;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Solution Created')]);
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
        if (!auth()->user()->can('solution.update')) {
            abort(403, 'Unauthorized action.');
        }

        // find the data
        $model = Solution::findOrFail($id);

        // return
        return view('admin.solution.edit', compact('model'));
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
        if (!auth()->user()->can('solution.update')) {
            abort(403, 'Unauthorized action.');
        }

        // find the data
        $model = Solution::findOrFail($id);
        $model->link_name = $request->link_name;
        $model->title = $request->title;
        // $model->header = $request->header;
        $model->content = $request->content;
        $model->button_text = $request->button_text;
        $model->button_url = $request->button_url;
        $model->open_another_tab = $request->open_another_tab;
        $model->youtube_video = $request->youtube_video;
        // if($request->hasFile('background_picture')) {
        //     $storagePath = $request->file('background_picture')->store('public/home-page-content/');
        //     $background_picture = basename($storagePath);
        //     $model->background_picture = $background_picture;
        // }
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Solution Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Solution::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
