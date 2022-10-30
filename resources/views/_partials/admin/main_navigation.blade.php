<?php $index = 1;?>
<div class="card card-sidebar-mobile  noprint">
	<ul class="nav nav-sidebar" data-nav-type="accordion">
		{{-- @if(Request::segment($index + 1) == 'configuration')
		@include('_partials.admin.configuration', compact('index'))
		@else --}}
		<li class="nav-item">
			<a href="{{route('home')}}" class="nav-link{{ Request::is('home') ? ' active' : '' }}">
				<i class="icon-home4"></i>
				<span>
					{{_lang('dashboard')}}
				</span>
			</a>
		</li>

		<li class="nav-item">
			<a href="{{ route('admin.report.get_demo') }}" class="nav-link{{ Request::is('admin/report/get-demo') ? ' active' : '' }}">
				<i class="icon-magazine"></i>
				<span>
					{{_lang('Get Demo Report')}}
				</span>
			</a>
		</li>

		<li class="nav-item">
			<a href="{{ route('admin.report.newsletter') }}" class="nav-link{{ Request::is('admin/report/newsletter') ? ' active' : '' }}">
				<i class="icon-newspaper"></i>
				<span>
					{{_lang('Newsletter')}}
				</span>
			</a>
		</li>

		<li class="nav-item">
			<a href="{{ route('admin.report.contact') }}" class="nav-link{{ Request::is('admin/report/contact') ? ' active' : '' }}">
				<i class="icon-file-text2"></i>
				<span>
					{{_lang('Contact Information')}}
				</span>
			</a>
		</li>

		@if(auth()->user()->can('service_category.create'))
			<li class="nav-item">
				<a href="{{ route('admin.service-category.index') }}" class="nav-link{{ Request::is('admin/service-category') ? ' active' : '' }}">
					<i class="icon-book2"></i>
					<span>
						{{_lang('Service Category')}}
					</span>
				</a>
			</li>
		@endif
		
		@if(auth()->user()->can('service_sub_category.create'))
			<li class="nav-item">
				<a href="{{ route('admin.service-sub-category.index') }}" class="nav-link{{ Request::is('admin/service-sub-category') ? ' active' : '' }}">
					<i class="icon-book"></i>
					<span>
						{{_lang('Service Sub Category')}}
					</span>
				</a>
			</li>
		@endif
		
		@if(auth()->user()->can('service.create'))
			<li class="nav-item">
				<a href="{{ route('admin.service.index') }}" class="nav-link{{ Request::is('admin/service') || Request::is('admin/service/create') || Request::is('admin/service/edit') ? ' active' : '' }}">
					<i class="icon-magazine"></i>
					<span>
						{{_lang('Services')}}
					</span>
				</a>
			</li>
		@endif
		
		<li class="nav-item nav-item-submenu {{ Request::is('admin/training*') ? 'nav-item-expanded nav-item-open' : '' }}">
			<a href="#" class="nav-link"><i class="icon-user-plus"></i> <span>{{_lang('Training')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="{{_lang('Training')}}">
					
				<li class="nav-item">
					<a href="{{ route('admin.training-category.index') }}" class="nav-link {{Request::is('admin/training-category') ? 'active':''}} ">
						<i class="icon-ampersand"></i>
						{{_lang('Training Category')}}
					</a>
				</li>

				<li class="nav-item">
					<a href="{{ route('admin.training.index') }}" class="nav-link {{Request::is('admin/training') ? 'active':''}} ">
						<i class="icon-ampersand"></i>
						{{_lang('Training')}}
					</a>
				</li>
			</ul>
		</li>

		@if(auth()->user()->can('user.view') || auth()->user()->can('role.view') )
			<li class="nav-item nav-item-submenu {{ Request::is('admin/client-partner') || Request::is('admin/solution-card') || Request::is('admin/solution') || Request::is('admin/about-content') || Request::is('admin/home-page-services') || Request::is('admin/testimonial') || Request::is('admin/case-study') ||Request::is('admin/home-page-content') || Request::is('admin/card') || Request::is('admin/testimonial/create') || Request::is('admin/home-page/meta-information') || Request::is('admin/testimonial/edit') ?'nav-item-expanded nav-item-open':''}}">
				<a href="#" class="nav-link"><i class="icon-user-plus"></i> <span>{{_lang('Home Page')}}</span></a>
				<ul class="nav nav-group-sub" data-submenu-title="{{_lang('Home Page')}}">
					<li class="nav-item ">
						<a href="{{ route('admin.home-page.meta-information') }}" class="nav-link {{Request::is('admin/home-page/meta-information') ? 'active':''}}">
							<i class="icon-ampersand"></i>
							{{_lang('Meta Information')}}
						</a>
					</li>
					@can('home-page-content.view')
						<li class="nav-item ">
							<a href="{{ route('admin.home-page-content') }}" class="nav-link {{ Request::is('admin/d') ? 'active' : '' }}">
								<i class="icon-ampersand"></i>
								{{_lang('Extra Content')}}
							</a>
						</li>
					@endcan
					@can('card.view')
						<li class="nav-item ">
							<a href="{{ route('admin.card.index') }}" class="nav-link {{ Request::is('admin/card') ? 'active' : '' }}">
								<i class="icon-ampersand"></i>
								{{_lang('Card')}}
							</a>
						</li>
					@endcan
					@can('client_partner.view')
						<li class="nav-item ">
							<a href="{{ route('admin.client-partner.index') }}" class="nav-link {{ Request::is('admin/client-partner') ? 'active' : '' }}">
								<i class="icon-ampersand"></i>
								{{_lang('Client Partners')}}
							</a>
						</li>
					@endcan
					@can('solution-card.view')
						<li class="nav-item ">
							<a href="{{ route('admin.solution-card.index') }}" class="nav-link {{ Request::is('admin/solution-card') ? 'active' : '' }}">
								<i class="icon-ampersand"></i>
								{{_lang('Solution Card')}}
							</a>
						</li>
					@endcan
					@can('solution.view')
						<li class="nav-item ">
							<a href="{{ route('admin.solution.index') }}" class="nav-link {{ Request::is('admin/solution') ? 'active' : '' }}">
								<i class="icon-ampersand"></i>
								{{_lang('Solution')}}
							</a>
						</li>
					@endcan
					@can('about-content.view')
						<li class="nav-item ">
							<a href="{{ route('admin.about-content.index') }}" class="nav-link {{ Request::is('admin/about-content') ? 'active' : '' }}">
								<i class="icon-ampersand"></i>
								{{_lang('About Content')}}
							</a>
						</li>
					@endcan
					@can('home_page_services.view')
						<li class="nav-item ">
							<a href="{{ route('admin.home-page-services.index') }}" class="nav-link {{ Request::is('admin/home-page-services') ? 'active' : '' }}">
								<i class="icon-ampersand"></i>
								{{_lang('Services')}}
							</a>
						</li>
					@endcan
					@can('testimonial.view')
						<li class="nav-item ">
							<a href="{{ route('admin.testimonial.index') }}" class="nav-link {{ Request::is('admin/testimonial') || Request::is('admin/testimonial/create') || Request::is('admin/testimonial/edit') ? 'active' : '' }}">
								<i class="icon-ampersand"></i>
								{{_lang('Testimonial')}}
							</a>
						</li>
					@endcan
					@can('case_study.view')
						<li class="nav-item ">
							<a href="{{ route('admin.case-study.index') }}" class="nav-link {{ Request::is('admin/case-study') ? 'active' : '' }}">
								<i class="icon-ampersand"></i>
								{{_lang('Case Study')}}
							</a>
						</li>
					@endcan
				</ul>
			</li>
		@endif

		@if(auth()->user()->can('about_us.create'))
			<li class="nav-item">
				<a href="{{ route('admin.about.index') }}" class="nav-link{{ Request::is('admin/about*') ? ' active' : '' }}">
					<i class="icon-magazine"></i>
					<span>
						{{_lang('About Us')}}
					</span>
				</a>
			</li>
		@endif
		
		@if(auth()->user()->can('contact-us.create'))
			<li class="nav-item">
				<a href="{{ route('admin.contact-us') }}" class="nav-link{{ Request::is('admin/contact-us') ? ' active' : '' }}">
					<i class="icon-magazine"></i>
					<span>
						{{_lang('Contact Us')}}
					</span>
				</a>
			</li>
		@endif
		
		@if(auth()->user()->can('privacy-policy.create'))
			<li class="nav-item">
				<a href="{{ route('admin.privacy-policy') }}" class="nav-link{{ Request::is('admin/privacy-policy') ? ' active' : '' }}">
					<i class="icon-magazine"></i>
					<span>
						{{_lang('Privacy Policy')}}
					</span>
				</a>
			</li>
		@endif

		@if(auth()->user()->can('terms_and_condition.create'))
			<li class="nav-item">
				<a href="{{ route('admin.terms-and-condition') }}" class="nav-link{{ Request::is('admin/terms-and-condition') ? ' active' : '' }}">
					<i class="icon-magazine"></i>
					<span>
						{{_lang('Terms & Condition')}}
					</span>
				</a>
			</li>
		@endif
		
		@if(auth()->user()->can('blog.view') || auth()->user()->can('blog.view') )
			<li class="nav-item nav-item-submenu {{ Request::is('admin/blog-page-content') || Request::is('admin/blog-tag') || Request::is('admin/blog-category') || Request::is('admin/blog-author') || Request::is('admin/blog') || Request::is('admin/blog/create') ? 'nav-item-expanded nav-item-open' : '' }}">
				<a href="#" class="nav-link"><i class="icon-user-plus"></i> <span>{{_lang('Blog')}}</span></a>
				<ul class="nav nav-group-sub" data-submenu-title="{{_lang('Blog')}}">
						
					<li class="nav-item">
						<a href="{{ route('admin.blog-page-content') }}" class="nav-link {{Request::is('admin/blog-page-content') ? 'active':''}} ">
							<i class="icon-ampersand"></i>
							{{_lang('Blog Page SEO')}}
						</a>
					</li>

					<li class="nav-item">
						<a href="{{ route('admin.blog-tag.index') }}" class="nav-link {{Request::is('admin/blog-tag') ? 'active':''}} ">
							<i class="icon-ampersand"></i>
							{{_lang(' Tag')}}
						</a>
					</li>

					<li class="nav-item">
						<a href="{{ route('admin.blog-category.index') }}" class="nav-link {{Request::is('admin/blog-category') ? 'active':''}} ">
							<i class="icon-ampersand"></i>
							{{_lang('Category')}}
						</a>
					</li>

					<li class="nav-item">
						<a href="{{ route('admin.blog-author.index') }}" class="nav-link {{Request::is('admin/blog-author') ? 'active':''}} ">
							<i class="icon-ampersand"></i>
							{{_lang('Author')}}
						</a>
					</li>

					<li class="nav-item">
						<a href="{{ route('admin.blog.index') }}" class="nav-link {{Request::is('admin/blog') || Request::is('admin/blog/create') ? 'active':''}} ">
							<i class="icon-ampersand"></i>
							{{_lang('Blog')}}
						</a>
					</li>
					
				</ul>
			</li>
		@endif
		
		<li class="nav-item">
			<a href="{{ route('admin.news.index') }}" class="nav-link{{ Request::is('admin/news') || Request::is('admin/news/create') || Request::is('admin/news/edit') ? ' active' : '' }}">
				<i class="icon-newspaper"></i>
				<span>
					{{_lang('News')}}
				</span>
			</a>
		</li>

		<li class="nav-item">
			<a href="{{ route('admin.main_case_study.index') }}" class="nav-link{{ Request::is('admin/main_case_study') || Request::is('admin/main_case_study/create') || Request::is('admin/main_case_study/edit') ? ' active' : '' }}">
				<i class="icon-magazine"></i>
				<span>
					{{_lang('Case Study')}}
				</span>
			</a>
		</li>

		@if(auth()->user()->can('configuration.create'))
			<li class="nav-item">
				<a href="{{ route('admin.configuration') }}" class="nav-link{{ Request::is('admin/configuration') ? ' active' : '' }}">
					<i class="icon-cog"></i>
					<span>
						{{_lang('setting')}}
					</span>
				</a>
			</li>
		@endif

		@if(auth()->user()->can('home_page.view') || auth()->user()->can('home_page.view') )
			<li class="nav-item nav-item-submenu {{ Request::is('admin/user*') ? 'nav-item-expanded nav-item-open' : '' }}">
				<a href="#" class="nav-link"><i class="icon-user-plus"></i> <span>{{_lang('User Management')}}</span></a>
				<ul class="nav nav-group-sub" data-submenu-title="{{_lang('user_management')}}">
					@can('role.view')
						<li class="nav-item "><a href="{{ route('admin.user.role') }}" class="nav-link {{Request::is('admin/user/role*') ? 'active':''}}"><i class="icon-ampersand"></i>{{_lang('Role Permission')}}</a></li>
					@endcan
					@can('user.view')
						<li class="nav-item "><a href="{{ route('admin.user.index') }}" class="nav-link {{(Request::is('admin/user*') And !Request::is('admin/user/role*'))  ?'active':''}}"><i class="icon-ampersand"></i>{{_lang('User')}}</a></li>
					@endcan
				</ul>
			</li>
		@endif

		<li class="nav-item">
			<a href="{{ route('admin.mail-setup') }}" class="nav-link{{ Request::is('admin/mail-setup') ? ' active' : '' }}">
				<i class="icon-envelope"></i>
				<span>
					{{_lang('Email Template')}}
				</span>
			</a>
		</li>
 
	</ul>
</div>