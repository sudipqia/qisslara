<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceCategory;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Session;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!auth()->user()->can('service_category.view')) {
			abort(403, 'Unauthorized action.');
		}

		return view('admin.service_category.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = ServiceCategory::where('name', '!=', config('system.default_role.admin'))->orderBy('position', 'DESC')->get();
            
			return Datatables::of($document)
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
					return view('admin.service_category.action', compact('model'));
				})
                ->addColumn('change_position', function ($model) {

                    $last = ServiceCategory::orderBy('position', 'DESC')->first();
                    if($last) {
                        $last = $last->position;
                    } else {
                        $last = 1;
                    }

					return view('admin.service_category.change_position', compact('model', 'last'));
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

        return view('admin.service_category.create');
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

        $last = ServiceCategory::orderBy('position', 'DESC')->first();
        if($last) {
            $position = $last->position + 1;
        } else {
            $position = 1;
        }

        $hash = sha1(time());

        $user = new ServiceCategory;
        $user->name = $request->name;
        $user->status = $request->status;
        $user->archive = $request->archive;
        $user->hash = $hash;
        $user->position = $position;
        $user->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Service Category Created')]);
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
        $model = ServiceCategory::where('hash', $id)->firstOrFail();

        // return
        return view('admin.service_category.edit', compact('model'));
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

        $model = ServiceCategory::findOrFail($id);
        $model->name = $request->name;
        $model->status = $request->status;
        $model->archive = $request->archive;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Service Category Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ServiceCategory::where('hash', $id)->firstOrFail();
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }

    public function up($position)
    {

        $first =  ServiceCategory::orderBy('position', 'asc')->first();

        if ($position == $first->position) {

            Session::flash('error_message', 'This is already in first position!'); 
            return redirect()->route('admin.service-category.index');

        } else {

            $new_position = $position - 1;

            $new_category = ServiceCategory::where('position', $new_position)->first();
            $change_category = ServiceCategory::where('position', $position)->first();

            $change = array(
                'position' => $position
            );

            if($new_category) {
                ServiceCategory::where('id', $new_category->id)->update([
                    'position' => $position
                ]);
            }

            ServiceCategory::where('id', $change_category->id)->update([
                'position' => $new_position
            ]);

            Session::flash('success_message', 'Position Changed Successfully'); 
        }

        return redirect()->route('admin.service-category.index');
    }

    public function down($position)
    {

        $first =  ServiceCategory::orderBy('position', 'desc')->first();

        if ($position == $first->position) {

            Session::flash('error_message', 'This is already in first position!'); 
            return redirect()->route('admin.service-category.index');

        } else {

            $new_position = $position + 1;

            $new_category = ServiceCategory::where('position', $new_position)->first();

            $change_category = ServiceCategory::where('position', $position)->first();

            if($change_category) {
                ServiceCategory::where('id', $new_category->id)->update([
                    'position' => $position
                ]);
            }

            ServiceCategory::where('id', $change_category->id)->update([
                'position' => $new_position
            ]);

            Session::flash('success_message', 'Position Changed Successfully'); 
        }

        return redirect()->route('admin.service-category.index');
    }
}
