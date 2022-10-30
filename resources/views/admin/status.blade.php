{{-- @if ($model->status=='activated')
<a href="#" class="badge badge-success border-info-600 rounded-round" title="{{ _lang('Activated') }}" data-popup="tooltip" data-placement="bottom" data-url="{{ route('admin.user.change',['value'=>'suspend','id'=>$model->id]) }}" data-id="{{$model->id}}" data-status="1" id="change_status">{{_lang('Active')}}</a>
@else
<a href="#" class="badge badge-danger border-info-600 rounded-round" title="{{ _lang('Suspend') }}" data-popup="tooltip" data-placement="bottom" data-url="{{ route('admin.user.change',['value'=>'activated','id'=>$model->id]) }}" data-id="{{$model->id}}" data-status="0" id="change_status">{{_lang('Suspend')}}</a>
@endif --}}

<img src="{{ asset('asset/ajaxloader.gif') }}" id="status_loading_{{$model->id}}"  style="display: none">
	<label class="form-check-label" id="status_{{$model->id}}" title="{{ $model->status == 'activated' ? _lang('status_online_to_offline') : _lang('status_offline_to_online') }}" data-popup="tooltip-custom" data-placement="bottom">
		<input type="checkbox" class="form-check-status-switchery" id="change_status" data-id="{{ $model->id }}" data-status="{{ $model->status }}" data-url="{{ route('admin.user.change',['value'=> ($model->status == 'activated' ? 'suspend' : 'activated'),'id'=>$model->id])  }}" {{ $model->status == 'activated' ? 'checked' : '' }} data-fouc >
	</label>
