{{-- @if ($model->status == 1)
<span class="badge badge-success">@lang('trt.status.active')</span>
@endif
@if ($model->status == 0)
<span class="badge badge-warning">@lang('trt.status.inactive')</span>
@endif --}}
{{-- @can('change-status'.$permission) --}}
{{-- <span class="dropdown-item" id="change_status" data-id="{{ $model->id }}" data-status="{{ $model->status }}" data-url="{{ route($route.'status', $model->id )}}"><i class="icon-station"></i> @lang('satt.action.change_status')</span> --}}
{{-- @endcan --}}
<img src="{{ asset('asset/ajaxloader.gif') }}" id="status_loading_{{$model->id}}"  style="display: none">
	<label class="form-check-label" id="status_{{$model->id}}" title="{{ $model->status == 1 ? _lang('status_online_to_offline') : _lang('status_offline_to_online') }}" data-popup="tooltip-custom" data-placement="bottom">
		<input type="checkbox" class="form-check-status-switchery" id="change_status" data-id="{{ $model->id }}" data-status="{{ $model->status }}" data-url="{{ route($route.'status', $model->id )}}" {{ $model->status == 1 ? 'checked' : '' }} data-fouc >
	</label>
