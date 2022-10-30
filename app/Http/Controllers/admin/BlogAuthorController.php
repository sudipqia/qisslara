<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BlogAuthor;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class BlogAuthorController extends Controller
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

		return view('admin.blog_author.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = BlogAuthor::where('name', '!=', config('system.default_role.admin'))->orderBy('id', 'DESC')->get();
            
			return Datatables::of($document)
                ->editColumn('status', function ($model) {
                    $position = $model->status == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                    return $position;
                })
                ->editColumn('picture', function ($model) {
                    $position = '<img src="'. asset('storage/author/'. $model->picture) .'" alt="Author Photo" style="width:50px;">';
                    return $position;
                })
				->addIndexColumn()
				->addColumn('action', function ($model) {
					return view('admin.blog_author.action', compact('model'));
				})->rawColumns(['action', 'picture', 'status'])->make(true);
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

        return view('admin.blog_author.create');
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

        if($request->hasFile('picture')) {
            $file = $request->file('picture');
            $picture = $file->getClientOriginalName();
            $path = $file->storeAs('public/author', $picture);
        }

        if($request->hasFile('bg_photo')) {
            $file = $request->file('bg_photo');
            $bg_photo = $file->getClientOriginalName();
            $path = $file->storeAs('public/blog/author', $bg_photo);
        }

        $model = new BlogAuthor;
        $model->name = $request->name;
        $model->designation = $request->designation;
        $model->status = $request->status;
        $model->picture = $picture;
        $model->bg_photo = $bg_photo;
        $model->slug = $request->slug;
        $model->meta_title = $request->meta_title;
        $model->site_title = $request->site_title;
        $model->meta_keyword = $request->meta_keyword;
        $model->meta_description = $request->meta_description;
        $model->meta_article_tag = $request->meta_article_tag;
        $model->meta_script = $request->meta_script;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Author Created')]);
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
        $model = BlogAuthor::findOrFail($id);

        // return
        return view('admin.blog_author.edit', compact('model'));
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

        $model = BlogAuthor::findOrFail($id);
        $model->name = $request->name;
        $model->designation = $request->designation;
        $model->status = $request->status;
        $model->slug = $request->slug;
        $model->meta_title = $request->meta_title;
        $model->site_title = $request->site_title;
        $model->meta_keyword = $request->meta_keyword;
        $model->meta_description = $request->meta_description;
        $model->meta_article_tag = $request->meta_article_tag;
        $model->meta_script = $request->meta_script;

        if($request->hasFile('picture')) {
            $file = $request->file('picture');
            $picture = $file->getClientOriginalName();
            $path = $file->storeAs('public/author', $picture);
            $model->picture = $picture;
        }
        
        if($request->hasFile('bg_photo')) {
            $file = $request->file('bg_photo');
            $bg_photo = $file->getClientOriginalName();
            $path = $file->storeAs('public/blog/author', $bg_photo);
            $model->bg_photo = $bg_photo;
        }

        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Author Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = BlogAuthor::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
