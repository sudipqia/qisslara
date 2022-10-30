<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Card;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Setting;
use Carbon\Carbon;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('card.view')) {
			abort(403, 'Unauthorized action.');
		}

		return view('admin.card.index');
    }

    public function datatable(Request $request) {
		if ($request->ajax()) {
			$document = Card::where('header', '!=', config('system.default_role.admin'))->orderBy('id', 'DESC')->get();
            
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
					return view('admin.card.action', compact('model'));
				})->rawColumns(['action', 'icon', 'open'])->make(true);
		}
	}

    public function home_page_content(){
        return view('admin.home_page_contact.index');
    }

    public function submit_home_page_content(Request $request) {
        foreach($_POST as $key => $value){
            if($key == "_token"){
                continue;
            }
            
            $data = array();
            $data['value'] = $value; 
            $data['updated_at'] = Carbon::now();
            if(Setting::where('name', $key)->exists()){				
                Setting::where('name','=',$key)->update($data);			
            }else{
                $data['name'] = $key; 
                $data['created_at'] = Carbon::now();
                Setting::insert($data); 
            }
        }

        if($request->hasFile('banner_background_picture')) {
            $storagePath = $request->file('banner_background_picture')->store('public/logo');
            $fileName = basename($storagePath);
            $data['name']='banner_background_picture';
            $data['value'] = $fileName;

            if(Setting::where('name', "banner_background_picture")->exists()){				
                Setting::where('name','=',"banner_background_picture")->update($data);			
            }else{
                $data['created_at'] = Carbon::now();
                Setting::insert($data); 
            }
        }

        if($request->hasFile('solution_bg_picture')) {
            $file = $request->file('solution_bg_picture');
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('public/logo', $fileName);

            $data['name']='solution_bg_picture';
            $data['value'] = $fileName;

            if(Setting::where('name', "solution_bg_picture")->exists()){				
                Setting::where('name','=',"solution_bg_picture")->update($data);			
            }else{
                $data['created_at'] = Carbon::now();
                Setting::insert($data); 
            }
        }
        
        if($request->hasFile('banner_video_picture')) {
            $storagePath = $request->file('banner_video_picture')->store('public/logo');
            $fileName = basename($storagePath);
            $data['name']='banner_video_picture';
            $data['value'] = $fileName;

            if(Setting::where('name', "banner_video_picture")->exists()){				
                Setting::where('name','=',"banner_video_picture")->update($data);			
            }else{
                $data['created_at'] = Carbon::now();
                Setting::insert($data); 
            }
        }
        
        if($request->hasFile('get_demo_background_picture')) {
            $storagePath = $request->file('get_demo_background_picture')->store('public/logo');
            $fileName = basename($storagePath);
            $data['name']='get_demo_background_picture';
            $data['value'] = $fileName;

            if(Setting::where('name', "get_demo_background_picture")->exists()){				
                Setting::where('name','=',"get_demo_background_picture")->update($data);			
            }else{
                $data['created_at'] = Carbon::now();
                Setting::insert($data); 
            }
        }
        
        if($request->hasFile('case_study_bg_picture')) {
            $storagePath = $request->file('case_study_bg_picture')->store('public/logo');
            $fileName = basename($storagePath);
            $data['name']='case_study_bg_picture';
            $data['value'] = $fileName;

            if(Setting::where('name', "case_study_bg_picture")->exists()){				
                Setting::where('name','=',"case_study_bg_picture")->update($data);			
            }else{
                $data['created_at'] = Carbon::now();
                Setting::insert($data); 
            }
        }
        
        if($request->hasFile('home_about_picture')) {
            $storagePath = $request->file('home_about_picture')->store('public/logo');
            $fileName = basename($storagePath);
            $data['name']='home_about_picture';
            $data['value'] = $fileName;

            if(Setting::where('name', "home_about_picture")->exists()){				
                Setting::where('name','=',"home_about_picture")->update($data);			
            }else{
                $data['created_at'] = Carbon::now();
                Setting::insert($data); 
            }
        }

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('System Configuration Updated.')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('card.create')) {
			abort(403, 'Unauthorized action.');
		}

        return view('admin.card.create');
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
            $file = $request->file('icon');
            $icon = $file->getClientOriginalName();
            $path = $file->storeAs('public/home-page-content', $icon);
        }

        if($request->hasFile('background_picture')) {
            $file = $request->file('background_picture');
            $background_picture = $file->getClientOriginalName();
            $path = $file->storeAs('public/home-page-content', $background_picture);
        }

        $model = new Card;
        $model->header = $request->header;
        $model->content = $request->content;
        $model->sub_content = $request->sub_content;
        $model->button_text = $request->button_text;
        $model->button_url = $request->button_url;
        $model->open_another_tab = $request->open_another_tab;
        $model->list_one = $request->list_one;
        $model->list_two = $request->list_two;
        $model->list_three = $request->list_three;
        $model->icon = $icon;
        $model->background_picture = $background_picture;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Card Created')]);
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
        $model = Card::findOrFail($id);

        // return
        return view('admin.card.edit', compact('model'));
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

        $model = Card::findOrFail($id);
        $model->header = $request->header;
        $model->content = $request->content;
        $model->sub_content = $request->sub_content;
        $model->button_text = $request->button_text;
        $model->button_url = $request->button_url;
        $model->open_another_tab = $request->open_another_tab;
        $model->list_one = $request->list_one;
        $model->list_two = $request->list_two;
        $model->list_three = $request->list_three;

        if($request->hasFile('icon')) {
            $file = $request->file('icon');
            $icon = $file->getClientOriginalName();
            $path = $file->storeAs('public/home-page-content', $icon);
            $model->icon = $icon;
        }

        if($request->hasFile('background_picture')) {
            $file = $request->file('background_picture');
            $background_picture = $file->getClientOriginalName();
            $path = $file->storeAs('public/home-page-content', $background_picture);
            $model->background_picture = $background_picture;
        }

        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Card Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Card::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
