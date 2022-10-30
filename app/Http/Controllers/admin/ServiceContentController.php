<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use App\ServiceContent;
use Session;

class ServiceContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($hash)
    {
        if (!auth()->user()->can('service.create')) {
			abort(403, 'Unauthorized action.');
		}

        $service = Service::where('hash', $hash)->firstOrFail();

        return view('admin.service-content.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $last = ServiceContent::orderBy('position', 'DESC')->first();
        if($last) {
            $position = $last->position + 1;
        } else {
            $position = 1;
        }

        $serviceId = $request->service_id;

        $service = Service::where('id', $serviceId)->first();

        $picture = null;
        $contentType = $request->content_type;
        $picture_alter_tag = $request->picture_alter_tag;
        $status = $request->status;
        $picture_link = null;
        $another_tab = 0;
        if($contentType == 'Only Content') {
            $content = $request->content;
        } elseif ($contentType == 'Only Picture') {
            $content = null;
            $picture_alter_tag = $request->picture_alter_tag;
            $picture_link = $request->picture_link;
            $another_tab = $request->another_tab;

            if($request->hasFile('only_picture')) {
                $file = $request->file('only_picture');
                $picture = $file->getClientOriginalName();
                $path = $file->storeAs('public/service', $picture);
            }
        } elseif ($contentType == 'Left Side Picture') {
            $content = $request->main_content;
            $picture_alter_tag = $request->left_side_picture_alter_tag;
            $picture = null;
            $picture_link = $request->max_picture_link;
            $another_tab = $request->max_another_tab;
            if($request->hasFile('picture')) {
                $file = $request->file('picture');
                $picture = $file->getClientOriginalName();
                $path = $file->storeAs('public/service', $picture);
            }
        } elseif ($contentType == 'Right Side Picture') {
            $content = $request->main_content;
            $picture = null;
            $picture_alter_tag = $request->right_side_picture_alter_tag;
            $picture_link = $request->max_picture_link;
            $another_tab = $request->max_another_tab;
            if($request->hasFile('picture')) {
                $file = $request->file('picture');
                $picture = $file->getClientOriginalName();
                $path = $file->storeAs('public/service', $picture);
            }
        }

        $status = 1;

        $model = new ServiceContent;
        $model->service_id = $serviceId;
        $model->content_type = $contentType;
        if($picture) {
            $model->picture = $picture;
        }
        if($picture_alter_tag) {
            $model->picture_alter_tag = $picture_alter_tag;
        }
        $model->content = $content;
        $model->status = 1;
        $model->position = $position;
        $model->picture_link = $picture_link;
        $model->another_tab = $another_tab;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Content Created'), 'goto' => url('admin/service/'. $service->hash . '/edit')]);
    }

    public function up($position)
    {

        $first = ServiceContent::orderBy('position', 'ASC')->first();

        $content = ServiceContent::where('position', $position)->first();
        $service = Service::where('id', $content->service_id)->first();

        if ($position == $first->position) {

            Session::flash('error_message', 'This is already in first position!'); 
            return redirect()->to('admin/service/'. $service->hash . '/edit');

        } else {

            $new_position = $position - 1;

            $new_category = ServiceContent::where('position', $new_position)->first();
            $change_category = ServiceContent::where('position', $position)->first();

            $change = array(
                'position' => $position
            );

            if($new_category) {
                ServiceContent::where('id', $new_category->id)->update([
                    'position' => $position
                ]);
            }

            ServiceContent::where('id', $change_category->id)->update([
                'position' => $new_position
            ]);

            Session::flash('success_message', 'Position Changed Successfully'); 
        }

        return redirect()->to('admin/service/'. $service->hash . '/edit');
    }

    public function down($position)
    {

        $first =  ServiceContent::orderBy('position', 'desc')->first();

        $content =  ServiceContent::where('position', $position)->first();
        $service = Service::where('id', $content->service_id)->first();
        
        if ($position == $first->position) {

            Session::flash('error_message', 'This is already in first position!'); 
            return redirect()->to('admin/service/'. $service->hash . '/edit');

        } else {

            $new_position = $position + 1;

            $new_category = ServiceContent::where('position', $new_position)->first();

            $change_category = ServiceContent::where('position', $position)->first();

            if($change_category) {
                ServiceContent::where('id', $new_category->id)->update([
                    'position' => $position
                ]);
            }

            ServiceContent::where('id', $change_category->id)->update([
                'position' => $new_position
            ]);

            Session::flash('success_message', 'Position Changed Successfully'); 
        }

        return redirect()->to('admin/service/'. $service->hash . '/edit');
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
        $model = ServiceContent::where('id', $id)->firstOrFail();
        $service = Service::where('id', $model->service_id)->firstOrFail();

        return view('admin.service-content.edit', compact('model', 'service'));
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
        
        $serviceId = $request->service_id;
        $service = Service::where('id', $serviceId)->first();

        $picture = null;
        $contentType = $request->content_type;
        $picture_alter_tag = $request->picture_alter_tag;
        $status = $request->status;
        if($contentType == 'Only Content') {
            $content = $request->content;
        } elseif ($contentType == 'Only Picture') {
            $content = null;
            $picture = null;
            $picture_alter_tag = $request->picture_alter_tag;
            if($request->hasFile('picture')) {
                $file = $request->file('picture');
                $picture = $file->getClientOriginalName();
                $path = $file->storeAs('public/service', $picture);
            }
        } elseif ($contentType == 'Left Side Picture') {
            $content = $request->main_content;
            $picture_alter_tag = $request->left_side_picture_alter_tag;
            $picture = null;
            if($request->hasFile('left_side_picture')) {
                $file = $request->file('left_side_picture');
                $picture = $file->getClientOriginalName();
                $path = $file->storeAs('public/service', $picture);
            }
        } elseif ($contentType == 'Right Side Picture') {
            $content = $request->main_content;
            $picture = null;
            $picture_alter_tag = $request->right_side_picture_alter_tag;
            if($request->hasFile('right_side_picture')) {
                $file = $request->file('right_side_picture');
                $picture = $file->getClientOriginalName();
                $path = $file->storeAs('public/service', $picture);
            }
        }

        $model = ServiceContent::where('id', $id)->firstOrFail();
        $model->service_id = $serviceId;
        $model->content_type = $contentType;
        if($picture) {
            $model->picture = $picture;
        }
        if($picture_alter_tag) {
            $model->picture_alter_tag = $picture_alter_tag;
        }
        $model->content = $content;
        $model->status = $request->status;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Content Created'), 'goto' => url('admin/service/'. $service->hash . '/edit')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ServiceContent::where('id', $id)->firstOrFail();
        $service = Service::where('id', $id)->first();
        $model->delete();
        return response()->json(['success' => true, 'status' => 'success', 'load' => true, 'message' => _lang('Data Deleted Successfully')]);
    }
}
