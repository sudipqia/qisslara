<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AboutUs;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Session; 

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('admin.about.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = AboutUs::where('header', '!=', config('system.default_role.admin'))->get();
            
			return Datatables::of($document)
                ->editColumn('slug', function ($model) {
                    $status = '<a href="'. url($model->slug) .'" target="_blank">'. url($model->slug) .'</a>';
                    return $status;
                })
                ->editColumn('status', function ($model) {
                    $status = $model->status == 1 ? '<span class="badge badge-success">Actice</span>' : '<span class="badge badge-danger">Inactive</span>';
                    return $status;
                })
                ->editColumn('archive', function ($model) {
                    $status = $model->archive == 1 ? '<span class="badge badge-danger">Yes</span>' : '<span class="badge badge-success">No</span>';
                    return $status;
                })
				->addIndexColumn()
				->addColumn('action', function ($model) {
					return view('admin.about.action', compact('model'));
				})->rawColumns(['action', 'slug', 'archive', 'status'])->make(true);
		}
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about.create');
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
            'page_title' => ['required', 'max:255']
        ]);

        $model = new AboutUs;
        $model->slug = $request->slug;
        $model->page_title = $request->page_title;
        $model->meta_title = $request->meta_title;
        $model->meta_keyword = $request->meta_keyword;
        $model->meta_description = $request->meta_description;
        $model->article_tag = $request->article_tag;
        $model->header = $request->header;
        $model->sub_header = $request->sub_header;
        $model->description = $request->description;
        $model->status = $request->status;
        $model->archive = $request->archive;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('About Us Content Created'), 'goto' => route('admin.about.index')]);
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
        // find the data
        $model = AboutUs::where('id', $id)->firstOrFail();

        // return
        return view('admin.about.edit', compact('model'));
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
            'page_title' => ['required', 'max:255']
        ]);

        $model = AboutUs::findOrFail($id);
        $model->page_title = $request->page_title;
        $model->meta_title = $request->meta_title;
        $model->meta_keyword = $request->meta_keyword;
        $model->meta_description = $request->meta_description;
        $model->article_tag = $request->article_tag;
        $model->header = $request->header;
        $model->sub_header = $request->sub_header;
        $model->description = $request->description;
        $model->status = $request->status;
        $model->slug = $request->slug;
        $model->archive = $request->archive;

        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('About Us Content Updated'), 'goto' => route('admin.about.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = AboutUs::where('id', $id)->firstOrFail();
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
