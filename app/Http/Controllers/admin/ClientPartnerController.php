<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ClientPartner;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class ClientPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('client_partner.view')) {
			abort(403, 'Unauthorized action.');
		}

		return view('admin.client_partner.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = ClientPartner::where('alt_tag', '!=', config('system.default_role.admin'))->orderBy('id', 'DESC')->get();
            
			return Datatables::of($document)
                ->editColumn('picture', function ($model) {
                    $position = '<img style="width:150px;" src="'. asset('storage/home-page-content/'. $model->picture) .'" alt="Icon">';
                    return $position;
                })
				->addIndexColumn()
				->addColumn('action', function ($model) {
					return view('admin.client_partner.action', compact('model'));
				})->rawColumns(['action', 'picture', 'open'])->make(true);
		}
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('client_partner.create')) {
			abort(403, 'Unauthorized action.');
		}

        return view('admin.client_partner.create');
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
            'alt_tag' => ['required', 'max:255']
        ]);

        if($request->hasFile('picture')) {
            $storagePath = $request->file('picture')->store('public/home-page-content/');
            $picture = basename($storagePath);
        }

        $model = new ClientPartner;
        $model->alt_tag = $request->alt_tag;
        $model->picture = $picture;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Client Partner Created')]);
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
        if (!auth()->user()->can('client_partner.update')) {
            abort(403, 'Unauthorized action.');
        }

        // find the data
        $model = ClientPartner::findOrFail($id);

        // return
        return view('admin.client_partner.edit', compact('model'));
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
            'alt_tag' => ['required', 'max:255']
        ]);

        $model = ClientPartner::findOrFail($id);
        $model->alt_tag = $request->alt_tag;

        if($request->hasFile('picture')) {
            $storagePath = $request->file('picture')->store('public/home-page-content/');
            $picture = basename($storagePath);
            $model->picture = $picture;
        }

        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Client Partner Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ClientPartner::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
