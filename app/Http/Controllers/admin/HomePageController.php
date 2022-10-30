<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use Carbon\Carbon;

class HomePageController extends Controller
{
    public function meta_information() 
    {
        return view('admin.home_page.meta_information');
    }

    public function update_meta_information() 
    {
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

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Meta Information Updated.')]);
    }
}
