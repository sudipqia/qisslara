<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;
use App\BlogTag;
use App\BlogAuthor;
use App\BlogCategory;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class BlogController extends Controller
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

		return view('admin.blog.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = Blog::where('header', '!=', config('system.default_role.admin'))->orderBy('id', 'DESC')->get();
            
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
					return view('admin.blog.action', compact('model'));
				})->rawColumns(['action', 'is_archived', 'status'])->make(true);
		}
	}

    public function blog_page_content() {
        return view('admin.blog.blog_page_content');
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

        $categories = BlogCategory::where('status', 1)->get();
        $authors = BlogAuthor::where('status', 1)->get();
        $tags = BlogTag::where('status', 1)->where('is_archived', 0)->get();

        return view('admin.blog.create', compact('categories', 'authors', 'tags'));
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
            $path = $file->storeAs('public/blog', $cover_photo);
        }

        if($request->hasFile('main_photo')) {
            $file = $request->file('main_photo');
            $main_photo = $file->getClientOriginalName();
            $path = $file->storeAs('public/blog', $main_photo);
        }

        if($request->hasFile('blog_bg')) {
            $file = $request->file('blog_bg');
            $blog_bg = $file->getClientOriginalName();
            $path = $file->storeAs('public/blog', $blog_bg);
        }
        
        $tag = null;

        if($request->tags) {
            $tag = implode(',', $request->tags);
        }

        $model = new Blog;
        $model->main_photo_alt_tag = $request->main_photo_alt_tag;
        $model->cover_photo_alter_tag = $request->cover_photo_alter_tag;
        $model->meta_title = $request->meta_title;
        $model->slug = $request->slug;
        $model->site_title = $request->site_title;
        $model->meta_keyword = $request->meta_keyword;
        $model->meta_description = $request->meta_description;
        $model->meta_article_tag = $request->meta_article_tag;
        $model->meta_script = $request->meta_script;
        $model->category_id = $request->category_id;
        $model->author_id = $request->author_id;
        $model->header = $request->header;
        $model->sub_header = $request->sub_header;
        $model->content = $request->description;
        $model->status = $request->status;
        $model->is_archived = $request->is_archived;
        $model->tags = $tag;
        $model->blog_bg = $blog_bg;
        $model->cover_photo = $cover_photo;
        $model->main_photo = $main_photo;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Blog Created'), 'goto' => route('admin.blog.index')]);
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
        $model = Blog::findOrFail($id);
        $categories = BlogCategory::where('status', 1)->get();
        $tags = BlogTag::where('status', 1)->where('is_archived', 0)->get();
        $authors = BlogAuthor::where('status', 1)->get();

        // return
        return view('admin.blog.edit', compact('model', 'authors', 'categories', 'tags'));
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

        $tag = null;

        if($request->tags) {
            $tag = implode(',', $request->tags);
        }

        $model = Blog::findOrFail($id);
        $model->main_photo_alt_tag = $request->main_photo_alt_tag;
        $model->cover_photo_alter_tag = $request->cover_photo_alter_tag;
        $model->meta_title = $request->meta_title;
        $model->site_title = $request->site_title;
        $model->meta_keyword = $request->meta_keyword;
        $model->meta_description = $request->meta_description;
        $model->meta_article_tag = $request->meta_article_tag;
        $model->meta_script = $request->meta_script;
        $model->category_id = $request->category_id;
        $model->author_id = $request->author_id;
        $model->header = $request->header;
        $model->sub_header = $request->sub_header;
        $model->content = $request->description;
        $model->slug = $request->slug;
        $model->status = $request->status;
        $model->is_archived = $request->is_archived;
        $model->tags = $tag;

        if($request->hasFile('cover_photo')) {
            $file = $request->file('cover_photo');
            $cover_photo = $file->getClientOriginalName();
            $path = $file->storeAs('public/blog', $cover_photo);
            $model->cover_photo = $cover_photo;
        }

        if($request->hasFile('main_photo')) {
            $file = $request->file('main_photo');
            $main_photo = $file->getClientOriginalName();
            $path = $file->storeAs('public/blog', $main_photo);
            $model->main_photo = $main_photo;
        }

        if($request->hasFile('blog_bg')) {
            $file = $request->file('blog_bg');
            $blog_bg = $file->getClientOriginalName();
            $path = $file->storeAs('public/blog', $blog_bg);
            $model->blog_bg = $blog_bg;
        }

        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Blog Updated'), 'goto' => route('admin.blog.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Blog::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
