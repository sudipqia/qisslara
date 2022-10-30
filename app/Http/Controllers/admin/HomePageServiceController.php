<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HomePageContent;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class HomePageServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('home_page_services.view')) {
			abort(403, 'Unauthorized action.');
		}

		return view('admin.home_page_services.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = HomePageContent::where('header', '!=', config('system.default_role.admin'))->orderBy('id', 'DESC')->get();
            
			return Datatables::of($document)
                ->editColumn('icon', function ($model) {
                    $position = '<img style="width:50px;" src="'. asset('storage/home-page-content/'. $model->icon) .'" alt="Icon">';
                    return $position;
                })
                ->editColumn('open', function ($model) {
                    $position = $model->open == 1 ? 'Yes' : 'No';
                    return $position;
                })
				->addIndexColumn()
				->addColumn('action', function ($model) {
					return view('admin.home_page_services.action', compact('model'));
				})->rawColumns(['action', 'icon', 'open'])->make(true);
		}
	}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('home_page_services.create')) {
			abort(403, 'Unauthorized action.');
		}

        return view('admin.home_page_services.create');
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

        if($request->hasFile('icon')) {
            $storagePath = $request->file('icon')->store('public/home-page-content/');
            $icon = basename($storagePath);
        }

        $model = new HomePageContent;
        $model->header = $request->header;
        $model->content = $request->content;
        $model->sub_content = $request->sub_content;
        $model->button_text = $request->button_text;
        $model->button_url = $request->button_url;
        $model->open_another_tab = $request->open_another_tab;
        $model->icon = $icon;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created')]);
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
        if (!auth()->user()->can('card.update')) {
            abort(403, 'Unauthorized action.');
        }

        // find the data
        $model = HomePageContent::findOrFail($id);

        // return
        return view('admin.home_page_services.edit', compact('model'));
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

        $model = HomePageContent::findOrFail($id);
        $model->header = $request->header;
        $model->content = $request->content;
        $model->sub_content = $request->sub_content;
        $model->button_text = $request->button_text;
        $model->button_url = $request->button_url;
        $model->open_another_tab = $request->open_another_tab;

        if($request->hasFile('icon')) {
            $storagePath = $request->file('icon')->store('public/home-page-content/');
            $icon = basename($storagePath);
            $model->icon = $icon;
        }

        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = HomePageContent::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
