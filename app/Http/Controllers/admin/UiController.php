<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\User;
use App\Models\Employee\Employee;
use Validator;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\Storage;

class UiController extends Controller
{
   public function index()
   {
   	$id =Auth::user()->id;
   	$model =User::with('employee')->findOrFail($id);
    return view('admin.user.profile',compact('model'));
   }

   public function postprofile(Request $request)
   {
   	  if ($request->ajax()) {
			$validator = $request->validate([
				'date_of_birth' => ['sometimes', 'nullable','date'],
				'date_of_anniversary' => ['sometimes', 'nullable','date'],
				'photo' => 'mimes:jpeg,bmp,png,jpg,gif|max:2000',
			]);
			$id =Auth::user()->id;
        	$model =User::with('employee')->findOrFail($id);
        	$file_exit=$model->employee->photo;
        	 if($file_exit && $request->hasFile('photo'))
        	 {
        	 	Storage::delete('public/user/photo/'.$file_exit);
        	 	$storagepath = $request->file('photo')->store('public/user/photo');
                $fileName = basename($storagepath);
        	 }
        	 elseif ($file_exit) {
				$fileName =$file_exit;
			}
			else
			{
				$storagepath = $request->file('photo')->store('public/user/photo');
                $fileName = basename($storagepath);
			}
			$model->first_name =$request->first_name;
			$model->last_name =$request->last_name;
			$model->save();
			// .................
			$emp =Employee::where('user_id',$id)->first();
			$emp->first_name =$request->first_name;
			$emp->middle_name =$request->middle_name;
			$emp->last_name =$request->last_name;
			$emp->date_of_birth =$request->date_of_birth;
			$emp->date_of_anniversary =$request->date_of_anniversary;
			$emp->marital_status =$request->marital_status;
			$emp->contact_number =$request->contact_number;
			$emp->alternate_contact_number =$request->alternate_contact_number;
			$emp->email =$request->email;
			$emp->alternate_email =$request->alternate_email;
			$emp->nationality =$request->nationality;
			$emp->photo =$fileName;
			$emp->save();
			return $this->success(['message' => _lang('Profile Update.')]);
		}
   }

   public function password_change(Request $request)
   {
   	 if ($request->ajax()) {
			$validator = $request->validate([
		     'password' => ['required', 'string', 'min:6', 'confirmed'],
			]);

			$id =Auth::user()->id;
        	$model =User::findOrFail($id);
        	$model->password=bcrypt($request->password);
        	$model->save();
        	return $this->success(['message' => _lang('Password Change.')]);
		}
   }
}
