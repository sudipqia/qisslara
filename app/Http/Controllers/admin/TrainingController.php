<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TrainingCategory;
use App\Training;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('admin.training.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = Training::where('header', '!=', config('system.default_role.admin'))->get();
            
			return Datatables::of($document)
                ->editColumn('category', function ($model) {
                    $category = TrainingCategory::where('id', $model->category_id)->first();
                    if($category) {
                        $return = $category->name;
                    } else {
                        $return = '';
                    }
                    return $return;
                })
                ->editColumn('time', function ($model) {
                    $position = $model->event_date . ' '. $model->start_time . ' - '. $model->end_time;
                    return $position;
                })
                ->editColumn('status', function ($model) {
                    $position = $model->status == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                    return $position;
                })
                ->editColumn('archive', function ($model) {
                    $position = $model->is_archived == 1 ? '<span class="badge badge-danger">Yes</span>' : '<span class="badge badge-success">No</span>';
                    return $position;
                })
				->addIndexColumn()
				->addColumn('action', function ($model) {
					return view('admin.training.action', compact('model'));
				})->rawColumns(['category', 'time', 'action', 'archive', 'status'])->make(true);
		}
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = TrainingCategory::where('status', 1)->where('archive', 0)->orderBy('name', 'ASC')->get();
        return view('admin.training.create', compact('categories'));
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

        $picture = null;
        if($request->hasFile('picture')) {
            $file = $request->file('picture');
            $picture = $file->getClientOriginalName();
            $path = $file->storeAs('public/training', $picture);
        }

        $model = new Training;
        $model->category_id = $request->category_id;
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
        $model->event_date = $request->date;
        $model->start_time = $request->start_time;
        $model->end_time = $request->end_time;
        $model->picture = $picture;

        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Training Created'), 'goto' => route('admin.training.index')]);
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
        $model = Training::findOrFail($id);
        $categories = TrainingCategory::where('status', 1)->where('archive', 0)->orderBy('name', 'ASC')->get();

        // return
        return view('admin.training.edit', compact('categories', 'model'));
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

        $model = Training::findOrFail($id);
        $model->category_id = $request->category_id;
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
        $model->event_date = $request->date;
        $model->start_time = $request->start_time;
        $model->end_time = $request->end_time;

        if($request->hasFile('picture')) {
            $file = $request->file('picture');
            $picture = $file->getClientOriginalName();
            $path = $file->storeAs('public/news', $picture);
            $model->picture = $picture;
        }

        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Training Updated'), 'goto' => route('admin.training.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Training::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
