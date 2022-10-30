<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
// Route::group(['middleware' => ['install']], function () {
	Route::get('/','FrontendController@index')->name('index');

	Route::get('email-test','FrontendController@email_test')->name('email-test');

	Route::get('search','FrontendController@search')->name('search');
Route::get('get-event-category','FrontendController@getEventCategory')->name('get-event-category');
	Route::get('book-training/{id}','FrontendController@book_training')->name('book-training');
	Route::post('submit-booking-form','FrontendController@submit_form')->name('submit-booking-form');

	Route::post('submit-contact-form','FrontendController@submit_contact_form')->name('submit-contact-form');
	Route::get('submit-for-get-demo-request','FrontendController@get_demo_request')->name('submit-for-get-demo-request');
	Route::get('submit-for-newsletter','FrontendController@newsletter_request')->name('submit-for-newsletter');
	Route::get('about-us','FrontendController@about')->name('about-us');
	Route::get('show-banner-video','FrontendController@showBannerVideo')->name('show-banner-video');
	Route::get('privacy-policy','FrontendController@privacy_policy')->name('privacy-policy');
	Route::get('terms-and-condition','FrontendController@terms_and_condition')->name('terms-and-condition');
	Route::get('contact','FrontendController@contact_us')->name('contact');
	Route::get('learning-center','FrontendController@blog')->name('learning-center');
	Route::get('news','FrontendController@news')->name('news');
	Route::get('case-study','FrontendController@case_study')->name('case-study');
	Route::get('get_solution_details','FrontendController@get_solution_details')->name('get_solution_details');
	Route::get('get_testimonial_details','FrontendController@get_testimonial_details')->name('get_testimonial_details');

	Auth::routes();
	Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth']], function () {

		Route::get('report/get-demo/datatable', 'ReportController@get_demo_datatable')->name('report.get_demo.datatable');
		Route::get('report/get-demo', 'ReportController@get_demo')->name('report.get_demo');
		Route::get('/report/get-demo/delete/{id}', 'ReportController@delete_get_demo')->name('report.get_demo.delete');
		Route::get('report/newsletter/datatable', 'ReportController@newsletter_datatable')->name('report.newsletter.datatable');
		Route::get('report/newsletter', 'ReportController@newsletter')->name('report.newsletter');
		Route::get('/report/newsletter/delete/{id}', 'ReportController@delete_newsletter')->name('report.newsletter.delete');
		Route::get('report/contact/datatable', 'ReportController@contact_datatable')->name('report.contact.datatable');
		Route::get('report/contact', 'ReportController@contact_us_information')->name('report.contact');
		Route::get('/report/contact/view/{id}', 'ReportController@view_contact_information')->name('report.contact.view');
		Route::get('/report/contact/delete/{id}', 'ReportController@delete_contact_information')->name('report.contact.delete');

		Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');
		
		Route::get('training-category/datatable', 'TrainingCategoryController@datatable')->name('training-category.datatable');
		Route::resource('training-category', 'TrainingCategoryController');
		
		Route::get('training/datatable', 'TrainingController@datatable')->name('training.datatable');
		Route::resource('training', 'TrainingController');

		// Service Content
		Route::get('service-content/up/{position}', 'ServiceContentController@up')->name('service-content.up');
		Route::get('service-content/down/{position}', 'ServiceContentController@down')->name('service-content.down');
		Route::get('/service-content', 'ServiceContentController@index')->name('service-content.index');
		Route::get('/service-content/create/{hash}', 'ServiceContentController@create')->name('service-content.create');
		Route::post('/service-content/store', 'ServiceContentController@store')->name('service-content.store');
		Route::get('/service-content/edit/{id}', 'ServiceContentController@edit')->name('service-content.edit');
		Route::patch('/service-content/update/{id}', 'ServiceContentController@update')->name('service-content.update');
		Route::delete('/service-content/delete/{id}', 'ServiceContentController@destroy')->name('service-content.delete');
		
		// Blog
		Route::get('blog-page-content', 'BlogController@blog_page_content')->name('blog-page-content');
		Route::get('blog/datatable', 'BlogController@datatable')->name('blog.datatable');
		Route::resource('blog', 'BlogController');

		// Case Study
		Route::get('main_case_study/datatable', 'MainCaseStudyController@datatable')->name('main_case_study.datatable');
		Route::resource('main_case_study', 'MainCaseStudyController');

		// News
		Route::get('news/datatable', 'NewsController@datatable')->name('news.datatable');
		Route::resource('news', 'NewsController');

		// Blog Tag
		Route::get('blog-tag/datatable', 'BlogTagController@datatable')->name('blog-tag.datatable');
		Route::resource('blog-tag', 'BlogTagController');

		// Blog Category
		Route::get('blog-category/datatable', 'BlogCategoryController@datatable')->name('blog-category.datatable');
		Route::resource('blog-category', 'BlogCategoryController');

		// Blog Author
		Route::get('blog-author/datatable', 'BlogAuthorController@datatable')->name('blog-author.datatable');
		Route::resource('blog-author', 'BlogAuthorController');

		// about-us
		Route::get('about/datatable', 'AboutUsController@datatable')->name('about.datatable');
		Route::resource('about', 'AboutUsController');
// 		Route::get('about-us', 'OtherController@about_us')->name('about-us');
// 		Route::post('submit-about-us-content', 'OtherController@sub_about_us')->name('submit-about-us-content');
		Route::get('contact-us', 'OtherController@contact_us')->name('contact-us');
		Route::get('privacy-policy', 'OtherController@privacy_policy')->name('privacy-policy');
		Route::get('terms-and-condition', 'OtherController@terms_and_condition')->name('terms-and-condition');
		Route::post('submit-terms-and-condition', 'OtherController@submit_terms_and_condition')->name('submit-terms-and-condition');

		// card
		Route::get('home-page-content', 'CardController@home_page_content')->name('home-page-content');
		Route::post('submit-home-page-content', 'CardController@submit_home_page_content')->name('submit-home-page-content');
		Route::get('card/datatable', 'CardController@datatable')->name('card.datatable');
		Route::resource('card', 'CardController');
		
		// case-study
		Route::get('case-study/datatable', 'CaseStudyController@datatable')->name('case-study.datatable');
		Route::resource('case-study', 'CaseStudyController');
		
		// testimonial
		Route::get('testimonial/datatable', 'TestimonialController@datatable')->name('testimonial.datatable');
		Route::resource('testimonial', 'TestimonialController');
		
		// home-page-services
		Route::get('home-page-services/datatable', 'HomePageServiceController@datatable')->name('home-page-services.datatable');
		Route::resource('home-page-services', 'HomePageServiceController');
		
		// about-content
		Route::get('about-content/datatable', 'AboutContentController@datatable')->name('about-content.datatable');
		Route::resource('about-content', 'AboutContentController');
		
		// solution
		Route::get('solution/datatable', 'SolutionController@datatable')->name('solution.datatable');
		Route::resource('solution', 'SolutionController');
		
		// solution-card
		Route::get('solution-card/datatable', 'SolutionCardController@datatable')->name('solution-card.datatable');
		Route::resource('solution-card', 'SolutionCardController');
		
		// client-partner
		Route::get('client-partner/datatable', 'ClientPartnerController@datatable')->name('client-partner.datatable');
		Route::resource('client-partner', 'ClientPartnerController');
		
		Route::get('home-page/meta-information', 'HomePageController@meta_information')->name('home-page.meta-information');
		Route::post('home-page/store-meta-information', 'HomePageController@update_meta_information')->name('home-page.store-meta-information');

		Route::get('service-category/datatable', 'ServiceCategoryController@datatable')->name('service-category.datatable');
		Route::get('service-category/up/{position}', 'ServiceCategoryController@up')->name('service-category.up');
		Route::get('service-category/down/{position}', 'ServiceCategoryController@down')->name('service-category.down');
		Route::resource('service-category', 'ServiceCategoryController');

		Route::get('service-sub-category/datatable', 'ServiceSubCategoryController@datatable')->name('service-sub-category.datatable');
		Route::get('service-sub-category/up/{position}', 'ServiceSubCategoryController@up')->name('service-sub-category.up');
		Route::get('service-sub-category/down/{position}', 'ServiceSubCategoryController@down')->name('service-sub-category.down');
		Route::resource('service-sub-category', 'ServiceSubCategoryController');

		Route::get('service/datatable', 'ServiceController@datatable')->name('service.datatable');
		Route::get('service/get-sub-category', 'ServiceController@get_sub_category')->name('service.get_sub_category');
		Route::get('service/up/{position}', 'ServiceController@up')->name('service.up');
		Route::get('service/down/{position}', 'ServiceController@down')->name('service.down');
		Route::resource('service', 'ServiceController');

		//ui:::::::::::::::::::
		Route::get('/profile', 'UiController@index')->name('profile');
		Route::post('/profile', 'UiController@postprofile')->name('postprofile');
		Route::post('/password', 'UiController@password_change')->name('password');

		Route::match(['get', 'post'], 'configuration', 'SettingController@index')->name('configuration');
		Route::match(['get', 'post'], 'mail-setup', 'SettingController@mail_setup')->name('mail-setup');
		Route::post('/logo', 'SettingController@upload_logo')->name('logo');
		Route::post('/api', 'SettingController@api')->name('api');
		Route::post('/social', 'SettingController@api')->name('social');
		Route::post('/basic', 'SettingController@basic')->name('basic');
		
		/*::::::::::::::::::language:::::::::::::::::::::*/
		Route::get('/language', 'LanguageController@index')->name('language');
		Route::match(['get', 'post'], 'create', 'LanguageController@create')->name('language.create');
		Route::get('language/edit/{id?}', 'LanguageController@edit')->name('language.edit');
		Route::patch('language/update/{id}', 'LanguageController@update')->name('language.update');
		Route::delete('/language/delete/{id}', 'LanguageController@delete')->name('language.delete');
		
		/*::::::::::::::user role Permission:::::::::*/
		Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
			Route::get('/role', 'RoleController@index')->name('role');
			Route::get('/role/datatable', 'RoleController@datatable')->name('role.datatable');
			Route::any('/role/create', 'RoleController@create')->name('role.create');
			Route::get('/role/edit/{id}', 'RoleController@edit')->name('role.edit');
			Route::post('/role/edit', 'RoleController@update')->name('role.update');
			Route::delete('/role/delete/{id}', 'RoleController@distroy')->name('role.delete');
			//user:::::::::::::::::::::::::::::::::
			Route::get('/', 'UserController@index')->name('index');
			Route::match(['get', 'post'], 'create', 'UserController@create')->name('create');
			Route::put('/change/{value}/{id}', 'UserController@status')->name('change');
			Route::get('/edit/{id}', 'UserController@edit')->name('edit');
			Route::put('/edit', 'UserController@update')->name('update');
			Route::delete('/delete/{id}', 'UserController@destroy')->name('delete');
		});

	});

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('{id}', 'FrontendController@dynamic');
// });
// /*::::::::::::::::::::install::::::::::::::::::*/
// Route::get('/install', 'Install\InstallController@index')->name('install');
// Route::post('/install', 'Install\InstallController@terms');
// Route::get('/install/server', 'Install\InstallController@server')->name('install.server');
// Route::post('/install/server', 'Install\InstallController@check_server');
// Route::get('install/database', 'Install\InstallController@database')->name('install.database');
// Route::post('install/database', 'Install\InstallController@process_install');
// Route::get('install/user', 'Install\InstallController@create_user')->name('install.user');
// Route::post('install/user', 'Install\InstallController@store_user');
// Route::get('install/settings', 'Install\InstallController@system_settings')->name('install.settings');
// Route::post('install/settings', 'Install\InstallController@final_touch');