<img src="{{ asset('asset/ajaxloader.gif') }}" id="delete_loading_{{$model->id}}" style="display: none;">

<div class="list-icons" id="action_menu_{{$model->id}}">
	<div class="dropdown">
		<a href="#" class="list-icons-item" data-toggle="dropdown">
			<i class="icon-menu9"></i>
		</a>
		<div class="dropdown-menu dropdown-menu-right">
			<span class="dropdown-item" id="content_managment" data-url="{{ route('admin.about-content.edit', $model->id )}}"><i class="icon-pencil7"></i> 
				{{_lang('Edit') }}
			</span>
			<span class="dropdown-item" id="delete_item" data-id="{{ $model->id }}" data-url="{{ route('admin.about-content.destroy', $model->id )}}">
				<i class="icon-trash"></i>
				 {{_lang('delete')}} 
				</button>
			</span>
		</div>
	</div>
</div>