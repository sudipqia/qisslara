<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceCategory;
use App\ServiceSubCategory;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Session;

class ServiceSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('service_sub_category.view')) {
			abort(403, 'Unauthorized action.');
		}

		return view('admin.service_sub_category.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = ServiceSubCategory::where('name', '!=', config('system.default_role.admin'))->orderBy('position', 'DESC')->get();
            
			return Datatables::of($document)
                ->editColumn('status', function ($model) {
                    $status = $model->status == 1 ? '<span class="badge badge-success">Actice</span>' : '<span class="badge badge-danger">Inactive</span>';
                    return $status;
                })
                ->editColumn('category_id', function ($model) {
                    $category = ServiceCategory::where('id', $model->category_id)->first();

                    return $category->name;
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
					return view('admin.service_sub_category.action', compact('model'));
				})
                ->addColumn('change_position', function ($model) {

                    $last = ServiceSubCategory::orderBy('position', 'DESC')->first();
                    if($last) {
                        $last = $last->position;
                    } else {
                        $last = 1;
                    }
					return view('admin.service_sub_category.change_position', compact('model', 'last'));
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

        return view('admin.service_sub_category.create', compact('categories'));
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

        $last = ServiceSubCategory::orderBy('position', 'DESC')->first();
        if($last) {
            $position = $last->position + 1;
        } else {
            $position = 1;
        }

        $hash = sha1(time());

        $user = new ServiceSubCategory;
        $user->name = $request->name;
        $user->category_id = $request->category_id;
        $user->status = $request->status;
        $user->archive = $request->archive;
        $user->hash = $hash;
        $user->position = $position;
        $user->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Service Sub Category Created')]);
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
        if (!auth()->user()->can('service_sub_category.update')) {
            abort(403, 'Unauthorized action.');
        }

        // find the data
        $categories = ServiceCategory::where('status', 1)->orderBy('name', 'ASC')->get();
        $model = ServiceSubCategory::where('hash', $id)->firstOrFail();

        // return
        return view('admin.service_sub_category.edit', compact('model', 'categories'));
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
            'name' => 'required|max:255'
        ]);

        $model = ServiceSubCategory::findOrFail($id);
        $model->category_id = $request->category_id;
        $model->name = $request->name;
        $model->status = $request->status;
        $model->archive = $request->archive;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Service Sub Category Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ServiceSubCategory::where('hash', $id)->firstOrFail();
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }

    public function up($position)
    {

        $first =  ServiceSubCategory::orderBy('position', 'asc')->first();

        if ($position == $first->position) {

            Session::flash('error_message', 'This is already in first position!'); 
            return redirect()->route('admin.service-sub-category.index');

        } else {

            $new_position = $position - 1;

            $new_category = ServiceSubCategory::where('position', $new_position)->first();
            $change_category = ServiceSubCategory::where('position', $position)->first();

            $change = array(
                'position' => $position
            );

            if($new_category) {
                ServiceSubCategory::where('id', $new_category->id)->update([
                    'position' => $position
                ]);
            }

            ServiceSubCategory::where('id', $change_category->id)->update([
                'position' => $new_position
            ]);

            Session::flash('success_message', 'Position Changed Successfully'); 
        }

        return redirect()->route('admin.service-sub-category.index');
    }

    public function down($position)
    {

        $first =  ServiceSubCategory::orderBy('position', 'desc')->first();

        if ($position == $first->position) {

            Session::flash('error_message', 'This is already in first position!'); 
            return redirect()->route('admin.service-sub-category.index');

        } else {

            $new_position = $position + 1;

            $new_category = ServiceSubCategory::where('position', $new_position)->first();

            $change_category = ServiceSubCategory::where('position', $position)->first();

            if($change_category) {
                ServiceSubCategory::where('id', $new_category->id)->update([
                    'position' => $position
                ]);
            }

            ServiceSubCategory::where('id', $change_category->id)->update([
                'position' => $new_position
            ]);

            Session::flash('success_message', 'Position Changed Successfully'); 
        }

        return redirect()->route('admin.service-sub-category.index');
    }
}
