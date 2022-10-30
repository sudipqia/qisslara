<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SolutionCard;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class SolutionCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('solution_card.view')) {
			abort(403, 'Unauthorized action.');
		}

		return view('admin.solution_card.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = SolutionCard::where('header', '!=', config('system.default_role.admin'))->orderBy('id', 'DESC')->get();
            
			return Datatables::of($document)
                ->editColumn('open', function ($model) {
                    $category = $model->open_another_tab == 1 ? 'Yes' : 'No';
                    return $category;
                })
				->addIndexColumn()
				->addColumn('action', function ($model) {
					return view('admin.solution_card.action', compact('model'));
				})->rawColumns(['action', 'open'])->make(true);
		}
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('solution_card.create')) {
			abort(403, 'Unauthorized action.');
		}

        return view('admin.solution_card.create');
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

        $model = new SolutionCard;
        $model->header = $request->header;
        $model->sub_header = $request->sub_header;
        $model->list_one = $request->list_one;
        $model->list_two = $request->list_two;
        $model->list_three = $request->list_three;
        $model->list_four = $request->list_four;
        $model->button_text = $request->button_text;
        $model->button_url = $request->button_url;
        $model->open_another_tab = $request->open_another_tab;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Solution Card Created')]);
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
        if (!auth()->user()->can('solution_card.update')) {
            abort(403, 'Unauthorized action.');
        }

        // find the data
        $model = SolutionCard::findOrFail($id);

        // return
        return view('admin.solution_card.edit', compact('model'));
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
        if (!auth()->user()->can('solution_card.update')) {
            abort(403, 'Unauthorized action.');
        }

        // find the data
        $model = SolutionCard::findOrFail($id);
        $model->header = $request->header;
        $model->sub_header = $request->sub_header;
        $model->list_one = $request->list_one;
        $model->list_two = $request->list_two;
        $model->list_three = $request->list_three;
        $model->list_four = $request->list_four;
        $model->button_text = $request->button_text;
        $model->button_url = $request->button_url;
        $model->open_another_tab = $request->open_another_tab;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Solution Card Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = SolutionCard::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
