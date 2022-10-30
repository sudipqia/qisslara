<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BlogTag;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class BlogTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('blog.view')) {
			abort(403, 'Unauthorized action.');
		}

		return view('admin.blog_tag.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = BlogTag::where('name', '!=', config('system.default_role.admin'))->orderBy('id', 'DESC')->get();
            
			return Datatables::of($document)
                ->editColumn('status', function ($model) {
                    $position = $model->status == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                    return $position;
                })
                ->editColumn('is_archived', function ($model) {
                    $position = $model->is_archived == 1 ? '<span class="badge badge-danger">Yes</span>' : '<span class="badge badge-success">No</span>';
                    return $position;
                })
				->addIndexColumn()
				->addColumn('action', function ($model) {
					return view('admin.blog_tag.action', compact('model'));
				})->rawColumns(['action', 'is_archived', 'status'])->make(true);
		}
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('blog.create')) {
			abort(403, 'Unauthorized action.');
		}

        return view('admin.blog_tag.create');
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

        if($request->hasFile('bg_photo')) {
            $file = $request->file('bg_photo');
            $bg_photo = $file->getClientOriginalName();
            $path = $file->storeAs('public/blog/tag', $bg_photo);
        }
        
        $model = new BlogTag;
        $model->name = $request->name;
        $model->slug = $request->slug;
        $model->bg_photo = $bg_photo;
        $model->meta_title = $request->meta_title;
        $model->site_title = $request->site_title;
        $model->meta_keyword = $request->meta_keyword;
        $model->meta_description = $request->meta_description;
        $model->meta_article_tag = $request->meta_article_tag;
        $model->meta_script = $request->meta_script;
        $model->status = $request->status;
        $model->is_archived = $request->is_archived;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Tag Created')]);
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
        if (!auth()->user()->can('blog.update')) {
            abort(403, 'Unauthorized action.');
        }

        // find the data
        $model = BlogTag::findOrFail($id);

        // return
        return view('admin.blog_tag.edit', compact('model'));
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

        $model = BlogTag::findOrFail($id);
        $model->name = $request->name;
        $model->slug = $request->slug;
        $model->meta_title = $request->meta_title;
        $model->site_title = $request->site_title;
        $model->meta_keyword = $request->meta_keyword;
        $model->meta_description = $request->meta_description;
        $model->meta_article_tag = $request->meta_article_tag;
        $model->meta_script = $request->meta_script;
        $model->status = $request->status;
        $model->is_archived = $request->is_archived;

        if($request->hasFile('bg_photo')) {
            $file = $request->file('bg_photo');
            $bg_photo = $file->getClientOriginalName();
            $path = $file->storeAs('public/blog/tag', $bg_photo);
            $model->bg_photo = $bg_photo;
        }

        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Tag Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = BlogTag::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
