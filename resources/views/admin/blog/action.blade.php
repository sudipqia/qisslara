<img src="{{ asset('asset/ajaxloader.gif') }}" id="delete_loading_{{$model->id}}" style="display: none;">

<div class="list-icons" id="action_menu_{{$model->id}}">
	<div class="dropdown">
		<a href="#" class="list-icons-item" data-toggle="dropdown">
			<i class="icon-menu9"></i>
		</a>
		<div class="dropdown-menu dropdown-menu-right">
			<a href="{{ route('admin.blog.edit', $model->id )}}">
				<span class="dropdown-item"><i class="icon-pencil7"></i> 
					{{_lang('Edit') }}
				</span>
			</a>
			<span class="dropdown-item" id="delete_item" data-id="{{ $model->id }}" data-url="{{ route('admin.blog.destroy', $model->id )}}"><i class="icon-trash"></i>
				 {{_lang('delete')}} 
				</button></span>
		</div>
	</div>
</div>