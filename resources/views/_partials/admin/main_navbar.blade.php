<div class="navbar navbar-expand-md navbar-dark fixed-top  noprint">
	<div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
		<div class="navbar-brand navbar-brand-md">
			<a href="{{route('home')}}" class="d-inline-block">
				{!! getLogo() !!}
			</a>
		</div>

		<div class="navbar-brand navbar-brand-xs">
			<a href="{{route('home')}}" class="d-inline-block">
				{!! getSmLogo() !!}
			</a>
		</div>
	</div>
	<div class="d-flex flex-1 d-md-none">
		<div class="navbar-brand mr-auto">
			<a href="{{route('home')}}" class="d-inline-block">
				{!! getSmLogo() !!}
			</a>
		</div>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
			<i class="icon-tree5"></i>
		</button>

		<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
			<i class="icon-paragraph-justify3"></i>
		</button>
	</div>
	<div class="collapse navbar-collapse" id="navbar-mobile">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
					<i class="icon-paragraph-justify3"></i>
				</a>
			</li>
		</ul>
		<span class="navbar-text ml-md-3 mr-md-auto">
			<span class="badge bg-success">{{ _lang('online') }}</span>
			<a target="_blank" href="{{ URL::to('/') }}">
				<span class="badge bg-primary">{{ _lang('Go to FrontEnd') }}</span>
			</a>
		</span>
	</div>
</div>