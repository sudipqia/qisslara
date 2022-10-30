<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use App\ServiceCategory;
use App\ServiceSubCategory;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Session; 

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('service.view')) {
			abort(403, 'Unauthorized action.');
		}

		return view('admin.service.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = Service::where('header', '!=', config('system.default_role.admin'))->orderBy('position', 'DESC')->get();
            
			return Datatables::of($document)
                ->editColumn('category_id', function ($model) {
                    $category = ServiceCategory::where('id', $model->category_id)->first();
                    return $category->name;
                })
                ->editColumn('sub_category_id', function ($model) {
                    $sub_category = ServiceSubCategory::where('id', $model->sub_category_id)->first();
                    return $sub_category->name;
                })
                ->editColumn('status', function ($model) {
                    $status = $model->status == 1 ? '<span class="badge badge-success">Actice</span>' : '<span class="badge badge-danger">Inactive</span>';
                    return $status;
                })
                ->editColumn('archive', function ($model) {
                    $status = $model->archive == 1 ? '<span class="badge badge-danger">Yes</span>' : '<span class="badge badge-success">No</span>';
                    return $status;
                })
                ->editColumn('position', function ($model) {
                    $position = '<span class="badge badge-dark">'. $model->position .'</span>';
                    return $position;
                })
				->addIndexColumn()
				->addColumn('action', function ($model) {
					return view('admin.service.action', compact('model'));
				})
                ->addColumn('change_position', function ($model) {

                    $last = Service::orderBy('position', 'DESC')->first();
                    if($last) {
                        $last = $last->position;
                    } else {
                        $last = 1;
                    }

					return view('admin.service.change_position', compact('model', 'last'));
				})->rawColumns(['action', 'position', 'change_position', 'archive', 'status'])->make(true);
		}
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('service_category.create')) {
			abort(403, 'Unauthorized action.');
		}

        $categories = ServiceCategory::where('status', 1)->orderBy('name', 'ASC')->get();

        return view('admin.service.create', compact('categories'));
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

        $last = Service::orderBy('position', 'DESC')->first();
        if($last) {
            $position = $last->position + 1;
        } else {
            $position = 1;
        }

        $hash = sha1(time());

        $model = new Service;
        $model->category_id = $request->category_id;
        $model->sub_category_id = $request->sub_category_id;
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
        $model->hash = $hash;
        $model->position = $position;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Service Created'), 'goto' => route('admin.service.index')]);
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
        if (!auth()->user()->can('service_category.update')) {
            abort(403, 'Unauthorized action.');
        }

        // find the data
        $categories = ServiceCategory::where('status', 1)->orderBy('name', 'ASC')->get();
        $model = Service::where('hash', $id)->firstOrFail();

        $sub_categories = ServiceSubCategory::where('category_id', $model->category_id)->get();

        // return
        return view('admin.service.edit', compact('model', 'categories', 'sub_categories'));
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

        $model = Service::findOrFail($id);
        $model->category_id = $request->category_id;
        $model->sub_category_id = $request->sub_category_id;
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

        if($request->hasFile('background_picture')) {
            $file = $request->file('background_picture');
            $background_picture = $file->getClientOriginalName();
            $path = $file->storeAs('public/service', $background_picture);
            $model->background_picture = $background_picture;
        }

        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Service Updated'), 'goto' => route('admin.service.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Service::where('hash', $id)->firstOrFail();
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }

    public function get_sub_category(Request $request) 
    {
        $sub_categories = ServiceSubCategory::where('category_id', $request->value)->get();

        $data[] = [
            'id' => '',
            'text' => 'Select Sub Category'
        ];
        foreach($sub_categories as $sub_category) {
            $data[] = [
                'id' => $sub_category->id,
                'text' => $sub_category->name
            ];
        }

        echo json_encode($data);
    }

    public function up($position)
    {

        $first = Service::orderBy('position', 'asc')->first();

        if ($position == $first->position) {

            Session::flash('error_message', 'This is already in first position!'); 
            return redirect()->route('admin.service.index');

        } else {

            $new_position = $position - 1;

            $new_category = Service::where('position', $new_position)->first();
            $change_category = Service::where('position', $position)->first();

            $change = array(
                'position' => $position
            );

            if($new_category) {
                Service::where('id', $new_category->id)->update([
                    'position' => $position
                ]);
            }

            if($change_category) {
                Service::where('id', $change_category->id)->update([
                    'position' => $new_position
                ]);
            }
            

            Session::flash('success_message', 'Position Changed Successfully'); 
        }

        return redirect()->route('admin.service.index');
    }

    public function down($position)
    {

        $first = Service::orderBy('position', 'desc')->first();

        if ($position == $first->position) {

            Session::flash('error_message', 'This is already in first position!'); 
            return redirect()->route('admin.service.index');

        } else {

            $new_position = $position + 1;

            $new_category = Service::where('position', $new_position)->first();

            $change_category = Service::where('position', $position)->first();

            
            Service::where('id', $new_category->id)->update([
                'position' => $position
            ]);


            if($change_category) {
                Service::where('id', $change_category->id)->update([
                    'position' => $new_position
                ]);
            }
            
            Session::flash('success_message', 'Position Changed Successfully'); 
        }

        return redirect()->route('admin.service.index');
    }
}
