<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AboutContent;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class AboutContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('about_content.view')) {
			abort(403, 'Unauthorized action.');
		}

		return view('admin.about_content.index');
    }

    public function datatable(Request $request) {
        if ($request->ajax()) {
            $document = AboutContent::where('title', '!=', config('system.default_role.admin'))->orderBy('id', 'DESC')->get();
            
            return Datatables::of($document)
                ->editColumn('open', function ($model) {
                    $position = $model->open == 1 ? 'Yes' : 'No';
                    return $position;
                })
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return view('admin.about_content.action', compact('model'));
                })->rawColumns(['action', 'open'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('about_content.create')) {
			abort(403, 'Unauthorized action.');
		}

        return view('admin.about_content.create');
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
            'title' => ['required', 'max:255']
        ]);

        if($request->hasFile('picture')) {
            $storagePath = $request->file('picture')->store('public/home-page-content/');
            $picture = basename($storagePath);
        }

        $model = new AboutContent;
        $model->alt_tab = $request->alt_tab;
        $model->title = $request->title;
        $model->header = $request->header;
        $model->content = $request->content;
        $model->button_text = $request->button_text;
        $model->button_url = $request->button_url;
        $model->open_another_tab = $request->open_another_tab;
        $model->picture = $picture;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created')]);
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
        if (!auth()->user()->can('about_content.update')) {
            abort(403, 'Unauthorized action.');
        }

        // find the data
        $model = AboutContent::findOrFail($id);

        // return
        return view('admin.about_content.edit', compact('model'));
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
        if (!auth()->user()->can('about_content.update')) {
            abort(403, 'Unauthorized action.');
        }

        // find the data
        $model = AboutContent::findOrFail($id);
        $model->alt_tab = $request->alt_tab;
        $model->title = $request->title;
        $model->header = $request->header;
        $model->content = $request->content;
        $model->button_text = $request->button_text;
        $model->button_url = $request->button_url;
        $model->open_another_tab = $request->open_another_tab;
        if($request->hasFile('picture')) {
            $storagePath = $request->file('picture')->store('public/home-page-content/');
            $picture = basename($storagePath);
            $model->picture = $picture;
        }
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = AboutContent::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
