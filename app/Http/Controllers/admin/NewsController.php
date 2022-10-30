<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('news.view')) {
			abort(403, 'Unauthorized action.');
		}

		return view('admin.news.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = News::where('header', '!=', config('system.default_role.admin'))->orderBy('id', 'DESC')->get();
            
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
					return view('admin.news.action', compact('model'));
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
        if (!auth()->user()->can('news.create')) {
			abort(403, 'Unauthorized action.');
		}

        return view('admin.news.create');
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

        if($request->hasFile('cover_photo')) {
            $file = $request->file('cover_photo');
            $cover_photo = $file->getClientOriginalName();
            $path = $file->storeAs('public/news', $cover_photo);
        }

        if($request->hasFile('main_photo')) {
            $file = $request->file('main_photo');
            $main_photo = $file->getClientOriginalName();
            $path = $file->storeAs('public/news', $main_photo);
        }

        if($request->hasFile('blog_bg')) {
            $file = $request->file('blog_bg');
            $blog_bg = $file->getClientOriginalName();
            $path = $file->storeAs('public/news', $blog_bg);
        }
        
        $model = new News;
        $model->main_photo_alt_tag = $request->main_photo_alt_tag;
        $model->cover_photo_alter_tag = $request->cover_photo_alter_tag;
        $model->meta_title = $request->meta_title;
        $model->slug = $request->slug;
        $model->site_title = $request->site_title;
        $model->meta_keyword = $request->meta_keyword;
        $model->meta_description = $request->meta_description;
        $model->meta_article_tag = $request->meta_article_tag;
        $model->meta_script = $request->meta_script;
        $model->header = $request->header;
        $model->sub_header = $request->sub_header;
        $model->content = $request->description;
        $model->status = $request->status;
        $model->is_archived = $request->is_archived;
        $model->blog_bg = $blog_bg;
        $model->cover_photo = $cover_photo;
        $model->main_photo = $main_photo;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('News Created'), 'goto' => route('admin.news.index')]);
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
        $model = News::findOrFail($id);

        // return
        return view('admin.news.edit', compact('model'));
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

        $model = News::findOrFail($id);
        $model->main_photo_alt_tag = $request->main_photo_alt_tag;
        $model->cover_photo_alter_tag = $request->cover_photo_alter_tag;
        $model->meta_title = $request->meta_title;
        $model->site_title = $request->site_title;
        $model->meta_keyword = $request->meta_keyword;
        $model->meta_description = $request->meta_description;
        $model->meta_article_tag = $request->meta_article_tag;
        $model->meta_script = $request->meta_script;
        $model->header = $request->header;
        $model->sub_header = $request->sub_header;
        $model->content = $request->description;
        $model->slug = $request->slug;
        $model->status = $request->status;
        $model->is_archived = $request->is_archived;

        if($request->hasFile('cover_photo')) {
            $file = $request->file('cover_photo');
            $cover_photo = $file->getClientOriginalName();
            $path = $file->storeAs('public/news', $cover_photo);
            $model->cover_photo = $cover_photo;
        }

        if($request->hasFile('main_photo')) {
            $file = $request->file('main_photo');
            $main_photo = $file->getClientOriginalName();
            $path = $file->storeAs('public/news', $main_photo);
            $model->main_photo = $main_photo;
        }

        if($request->hasFile('blog_bg')) {
            $file = $request->file('blog_bg');
            $blog_bg = $file->getClientOriginalName();
            $path = $file->storeAs('public/news', $blog_bg);
            $model->blog_bg = $blog_bg;
        }

        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('News Updated'), 'goto' => route('admin.news.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = News::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
