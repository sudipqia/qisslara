
<div class="sidebar-user  noprint">
	<div class="card-body">
		<div class="media">
			<div class="mr-3">
				<a href="#"><img src="{{ asset('asset/global_assets/images/placeholders/placeholder.jpg') }}" width="38" height="38" class="rounded-circle" alt=""></a>
			</div>
			<div class="media-body">
				<div class="media-title font-weight-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
				<div class="font-size-xs opacity-50">
					<i class="icon-mention font-size-sm"></i> &nbsp; {{ auth()->user()->email }}
				</div>
			</div>
			<div class="ml-3 align-self-center">
				<a href="#" class="text-white"><i class="icon-cog3"></i></a>
			</div>
		</div>
	</div>
</div>
