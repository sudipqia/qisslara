<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Setting;
use Carbon\Carbon;

class OtherController extends Controller
{
    public function about_us()
    {
        return view('admin.optional.about_us');
    }

    public function sub_about_us(Request $request) {
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

        if($request->hasFile('about_bg')) {
            $storagePath = $request->file('about_bg')->store('public/about');
            $fileName = basename($storagePath);
            $data['name']='about_bg';
            $data['value'] = $fileName;

            if(Setting::where('name', "about_bg")->exists()){				
                Setting::where('name','=',"about_bg")->update($data);			
            }else{
                $data['created_at'] = Carbon::now();
                Setting::insert($data); 
            }
        }
        
        if($request->hasFile('about_image')) {
            $storagePath = $request->file('about_image')->store('public/about');
            $fileName = basename($storagePath);
            $data['name']='about_image';
            $data['value'] = $fileName;

            if(Setting::where('name', "about_image")->exists()){				
                Setting::where('name','=',"about_image")->update($data);			
            }else{
                $data['created_at'] = Carbon::now();
                Setting::insert($data); 
            }
        }

        if($request->hasFile('privacy_policy_bg')) {
            $storagePath = $request->file('privacy_policy_bg')->store('public/about');
            $fileName = basename($storagePath);
            $data['name']='privacy_policy_bg';
            $data['value'] = $fileName;

            if(Setting::where('name', "privacy_policy_bg")->exists()){				
                Setting::where('name','=',"privacy_policy_bg")->update($data);			
            }else{
                $data['created_at'] = Carbon::now();
                Setting::insert($data); 
            }
        }

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('System Configuration Updated.')]);
    }

    public function contact_us()
    {
        return view('admin.optional.contact_us');
    }

    public function privacy_policy()
    {
        return view('admin.optional.privacy_policy');
    }

    public function terms_and_condition()
    {
        return view('admin.optional.terms_and_condition');
    }

    public function submit_terms_and_condition(Request $request) {

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

        if($request->hasFile('term_bg')) {
            $storagePath = $request->file('term_bg')->store('public/about');
            $fileName = basename($storagePath);
            $data['name']='term_bg';
            $data['value'] = $fileName;

            if(Setting::where('name', "term_bg")->exists()){				
                Setting::where('name','=',"term_bg")->update($data);			
            }else{
                $data['created_at'] = Carbon::now();
                Setting::insert($data); 
            }
        }

        if($request->hasFile('contact_bg')) {
            $storagePath = $request->file('contact_bg')->store('public/about');
            $fileName = basename($storagePath);
            $data['name']='contact_bg';
            $data['value'] = $fileName;

            if(Setting::where('name', "contact_bg")->exists()){				
                Setting::where('name','=',"contact_bg")->update($data);			
            }else{
                $data['created_at'] = Carbon::now();
                Setting::insert($data); 
            }
        }

        if($request->hasFile('blog_bg')) {
            $storagePath = $request->file('blog_bg')->store('public/about');
            $fileName = basename($storagePath);
            $data['name']='blog_bg';
            $data['value'] = $fileName;

            if(Setting::where('name', "blog_bg")->exists()){				
                Setting::where('name','=',"blog_bg")->update($data);			
            }else{
                $data['created_at'] = Carbon::now();
                Setting::insert($data); 
            }
        }

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('System Configuration Updated.')]);
    }
}
