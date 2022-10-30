<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TrainingCategory;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class TrainingCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.training_category.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = TrainingCategory::where('name', '!=', config('system.default_role.admin'))->get();
            
			return Datatables::of($document)
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
					return view('admin.training_category.action', compact('model'));
				})->rawColumns(['action', 'archive', 'status'])->make(true);
		}
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.training_category.create');
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

        $user = new TrainingCategory;
        $user->name = $request->name;
        $user->status = $request->status;
        $user->archive = $request->archive;
        $user->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Training Category Created')]);
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
        $model = TrainingCategory::where('id', $id)->firstOrFail();

        // return
        return view('admin.training_category.edit', compact('model'));
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

        $model = TrainingCategory::findOrFail($id);
        $model->name = $request->name;
        $model->status = $request->status;
        $model->archive = $request->archive;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Training Category Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = TrainingCategory::where('id', $id)->firstOrFail();
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
