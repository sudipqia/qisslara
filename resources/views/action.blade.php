<img src="{{ asset('asset/ajaxloader.gif') }}" id="delete_loading_{{$model->id}}" style="display: none;">
<div class="list-icons" id="action_menu_{{$model->id}}">
	<div class="dropdown">
		<a href="#" class="list-icons-item" data-toggle="dropdown">
			<i class="icon-menu9"></i>
		</a>
		<div class="dropdown-menu dropdown-menu-right">
			{{-- @can('view'.$permission) --}}
			<span class="dropdown-item" id="content_managment" data-url="{{ route($route.'show', $model->id )}}"><i class="icon-eye"></i>{{ _lang('view') }}</span>
			{{-- @endcan --}}
			{{-- @can('update'.$permission) --}}
			<span class="dropdown-item" id="content_managment" data-url="{{ route($route.'edit', $model->id )}}"><i class="icon-pencil7"></i> {{ _lang('edit') }}</span>
			{{-- @endcan --}}
			{{-- @can('delete'.$permission) --}}
			<span class="dropdown-item" id="delete_item" data-id="{{ $model->id }}" data-url="{{ route($route.'destroy', $model->id )}}"><i class="icon-trash"></i> {{ _lang('delete') }} </button></span>
			{{-- @endcan --}}
		</div>
	</div>
</div>