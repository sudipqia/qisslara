<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\User;
use App\Blog;
use App\News;
use App\MainCaseStudy;
use App\BlogCategory;
use App\BlogAuthor;
use App\BlogTag;
use App\Service;
use App\Solution;
use App\Testimonial;
use App\GetDemo;
use App\Newsletter;
use App\Training;
use App\NewsletterInformation;
use App\ContactInformation;
use App\TrainingCandidate;
use Validator;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\Storage;
use \stdClass;
use DB;
use Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\AboutUs;

class FrontendController extends Controller
{
    public function email_test() {
        require base_path("vendor/autoload.php");
        
        
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {

            // Email server settings
            $mail->SMTPDebug = 1;
            $mail->isSMTP();
            $mail->Host = 'qi-a.com';             //  smtp host
            $mail->SMTPAuth = true;

            $mail->Username = 'test@qi-a.com';   //  sender username
            $mail->Password = 'riw&1X+4K!*}';       // sender password Qi@2022Qi$$S@les
            $mail->SMTPSecure = 'ssl';                  // encryption - ssl/tls
            $mail->Port = 465;                          // port - 587/465

            $mail->setFrom('test@qi-a.com', 'This is Sender Name');
            $mail->addAddress('sadik.cse15@gmail.com');

            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = "This is a Subject";
            $mail->Body    = "This is a body 2";

            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
                dd("Fail");
            }
            
            else {
                dd("Done");
            }

        } catch (Exception $e) {
             dd($e);
        }
    }
    
    public function index()
    {
        $date = date('Y-m-d');

        $meta = new \stdClass();

        $meta->title = get_option('home_site_title') ? get_option('home_site_title') : 'QI-A';
        $meta->meta_title = get_option('meta_title') ? get_option('meta_title') : 'QI-A';
        $meta->meta_keyword = get_option('meta_keyword');
        $meta->article_tag = get_option('article_tag');
        $meta->meta_description = get_option('meta_description');

        return view('frontend.welcome', compact('meta'));
    }
    
    public function about() {
        $meta = new \stdClass();

        $meta->title = get_option('about_site_title') ? get_option('about_site_title') : 'QI-A';
        $meta->meta_title = get_option('about_meta_title') ? get_option('about_meta_title') : 'QI-A';
        $meta->meta_keyword = get_option('about_meta_keyword');
        $meta->article_tag = get_option('about_meta_article');
        $meta->script_tag = get_option('about_meta_link');
        $meta->meta_description = get_option('about_meta_description');

        return view('frontend.about', compact('meta'));
    }

      public function submit_contact_form() {
        $name = request()->name;
        $email = request()->email;
        $phone = request()->phone;
        $website = request()->website;
        $message = request()->message;
        $origin = request()->origin;

        if(trim($name) == '') {
            echo json_encode(['status' => 'danger', 'message' => 'Name is Required']);
            exit();
        }

        // check valid email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'danger', 'message' => 'Invalid Email Address']);
            exit();
        }

        // check DNS
        // $domain = explode('@', $email);
        // if (!checkdnsrr($domain[1] , "MX")) {
        //     echo json_encode(['status' => 'danger', 'message' => 'Email Address is not Active']);
        //     exit();
        // }

        if(trim($phone) == '') {
            echo json_encode(['status' => 'danger', 'message' => 'Phone Number is Required']);
            exit();
        }

        // if(!preg_match('/^[0-9]{4}-[0-9]{7}$/', $phone)){
        //     echo json_encode(['status' => 'danger', 'message' => 'Invalid Phone Number Format']);
        //     exit();
        // }

        if(trim($website) == '') {
            echo json_encode(['status' => 'danger', 'message' => 'Website is Required']);
            exit();
        }
        if(trim($message) == '') {
            echo json_encode(['status' => 'danger', 'message' => 'Message is Required']);
            exit();
        }

        $model = new ContactInformation;
        $model->name = $name;
        $model->email = $email;
        $model->phone = $phone;
        $model->subject = $website;
        $model->message = $message;
        $model->origin = $origin;
        $model->save();

        $data = [
            'name' => $name,    
            'email' => $email,    
            'phone' => $phone,    
            'website' => $website,    
        ];

        $customerContent = get_option('client_contact_template');
        $adminContent = get_option('admin_contact_template');
        $customerContent = str_replace('[CLIENT_NAME]', $name, $customerContent);
        $adminContent = str_replace('[CLIENT_NAME]', $name, $adminContent);
        $customerContent = str_replace('[CLIENT_EMAIL]', $email, $customerContent);
        $adminContent = str_replace('[CLIENT_EMAIL]', $email, $adminContent);
        $customerContent = str_replace('[CLIENT_PHONE]', $phone, $customerContent);
        $adminContent = str_replace('[CLIENT_PHONE]', $phone, $adminContent);
        $customerContent = str_replace('[CLIENT_WEBSITE]', $website, $customerContent);
        $adminContent = str_replace('[CLIENT_WEBSITE]', $website, $adminContent);
        $customerContent = str_replace('[CLIENT_MESSAGE]', $message, $customerContent);
        $adminContent = str_replace('[CLIENT_MESSAGE]', $message, $adminContent);
        $data['customerContent'] = $customerContent;
        $data['adminContent'] = $adminContent;
        
        Mail::send([], $data, function($message) use ($data) {
            $message->to($data['email'], $data['name'])
            ->replyTo("info@qi-a.com", "Quality Institute of America")
            ->setBody($data['customerContent'], 'text/html')
            ->setSubject('Thank you for requesting a Demonstration');
            $message->from('info@qi-a.com','Quality Institute of America');
        });
        
        // $adminEmail = $this->_sendMail("sales@qi-a.com", 'Quality Institute of America', $email, "sales@qi-a.com", "A new contact form submitted from website", $data['adminContent']);


        echo json_encode(['status' => 'success', 'message' => 'Thank you for contacting with us. We will be back to you as soon as possible. ']);
        exit();
    }
    
    public function _sendMail($from, $fromName, $replyTo, $to, $subject, $body)
    {
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);
        try {

            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtpout.secureserver.net';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'sales@qi-a.com';   //  sender username
            $mail->Password = 'Qi@2022Qi$$S@les';       // sender password
            $mail->SMTPSecure = 'ssl';                  // encryption - ssl/tls
            $mail->Port = 465; 

            $mail->addReplyTo($replyTo);
            $mail->setFrom($from, $fromName);
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            if( !$mail->send() ) {
                return false;
            } else {
                return true;
            }

        } catch (Exception $e) {
            return false;
        }
    }
    
    public function contact_us() {
        $meta = new \stdClass();

        $meta->title = get_option('contact_site_title') ? get_option('contact_site_title') : 'QI-A';
        $meta->meta_title = get_option('contact_meta_title') ? get_option('contact_meta_title') : 'QI-A';
        $meta->meta_keyword = get_option('contact_meta_keyword');
        $meta->article_tag = get_option('contact_article_article');
        $meta->meta_description = get_option('contact_meta_description');

        return view('frontend.contact_us', compact('meta'));
    }

    public function privacy_policy() {
        $meta = new \stdClass();

        $meta->title = get_option('home_site_title') ? get_option('home_site_title') : 'QI-A';
        $meta->meta_title = get_option('meta_title') ? get_option('meta_title') : 'QI-A';
        $meta->meta_keyword = get_option('meta_keyword');
        $meta->article_tag = get_option('article_tag');
        $meta->meta_description = get_option('meta_description');

        return view('frontend.privacy_policy', compact('meta'));
    }

    public function terms_and_condition() {
        $meta = new \stdClass();

        $meta->title = get_option('term_site_ttile') ? get_option('term_site_ttile') : 'QI-A';
        $meta->meta_title = get_option('term_meta_title') ? get_option('term_meta_title') : 'QI-A';
        $meta->meta_keyword = get_option('term_meta_keyword');
        $meta->article_tag = get_option('term_article_tab');
        $meta->meta_description = get_option('term_meta_description');

        return view('frontend.terms_and_condition', compact('meta'));
    }

    public function blog() {
        $meta = new \stdClass();

        $meta->title = get_option('blog_site_title') ? get_option('blog_site_title') : 'QI-A';
        $meta->meta_title = get_option('blog_meta_title') ? get_option('blog_meta_title') : 'QI-A';
        $meta->meta_keyword = get_option('blog_meta_keyword');
        $meta->article_tag = get_option('blog_article_tag');
        $meta->meta_description = get_option('blog_meta_description');

        $blogs = Blog::where('status', 1)->where('is_archived', 0)->orderBy('id', 'DESC')->paginate(5);
        $categories = BlogCategory::where('status', 1)->get();
        $tags = BlogTag::where('status', 1)->where('is_archived', 0)->get();

        return view('frontend.blog', compact('meta', 'blogs', 'categories', 'tags'));
    }
    
    public function news() {
        $meta = new \stdClass();

        $meta->title = get_option('news_site_title') ? get_option('news_site_title') : 'QI-A';
        $meta->meta_title = get_option('news_meta_title') ? get_option('news_meta_title') : 'QI-A';
        $meta->meta_keyword = get_option('news_meta_keyword');
        $meta->article_tag = get_option('news_article_tag');
        $meta->meta_description = get_option('news_meta_description');

        $blogs = News::where('status', 1)->where('is_archived', 0)->paginate(5);
        return view('frontend.news', compact('meta', 'blogs'));
    }
    
    public function case_study() {
        $meta = new \stdClass();

        $meta->title = get_option('case_study_site_title') ? get_option('case_study_site_title') : 'QI-A';
        $meta->meta_title = get_option('case_study_meta_title') ? get_option('case_study_meta_title') : 'QI-A';
        $meta->meta_keyword = get_option('case_study_meta_keyword');
        $meta->article_tag = get_option('case_study_article_tag');
        $meta->meta_description = get_option('case_study_meta_description');

        $blogs = MainCaseStudy::where('status', 1)->where('is_archived', 0)->paginate(5);

        return view('frontend.case_study', compact('meta', 'blogs'));
    }

    public function get_solution_details() {
        $solutionId = request()->id;

        $solution = Solution::where('id', $solutionId)->first();

        return view('frontend.solution_details', compact('solution'));
    }

    public function get_testimonial_details() {
        $id = request()->id;
        
        $model = Testimonial::where('id', $id)->first();

        return view('frontend.testimonial_details', compact('model'));
    }

    public function get_demo_request() {
        $email = request()->email;

        // check valid email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 0, 'message' => 'Invalid Email Address']);
            exit();
        }

        // check DNS
        // $domain = explode('@', $email);
        // if (!checkdnsrr($domain[1] , "MX")) {
        //     echo json_encode(['status' => 0, 'message' => 'Email Address is not Active']);
        //     exit();
        // }

        // check on database
        $find = GetDemo::where('email', $email)->first();
        if($find) {
            echo json_encode(['status' => 0, 'message' => 'Your Email Address is already exist in our system. We will contact with you. Thank You']);
            exit();
        } else {
            $model = new GetDemo;
            $model->email = $email;
            $model->save();

            $data = [
                'email' => $email,    
            ];
    
            $customerContent = get_option('client_get_demo_template');
            $adminContent = get_option('admin_get_demo_template');
            $customerContent = str_replace('[CLIENT_EMAIL]', $email, $customerContent);
            $adminContent = str_replace('[CLIENT_EMAIL]', $email, $adminContent);
            $data['customerContent'] = $customerContent;
            $data['adminContent'] = $adminContent;
            
            // Mail::send([], $data, function($message) use ($data) {
            //     $message->to($data['email'])
            //     ->replyTo("sales@qi-a.com", "Quality Institute of America")
            //     ->setBody($data['customerContent'], 'text/html')
            //     ->setSubject('Thank you for requesting a Demonstration');
            //     $message->from('sales@qi-a.com','Quality Institute of America');
            // });
            
            Mail::send([], $data, function($message) use ($data) {
                $message->to($data['email'])
                ->replyTo("info@qi-a.com", "Quality Institute of America")
                ->setBody($data['customerContent'], 'text/html')
                ->setSubject('Thank you for requesting a Demonstration');
                $message->from('info@qi-a.com','Quality Institute of America');
            });
            
            Mail::send([], $data, function($message) use ($data) {
                $message->to('info@qi-a.com', "QI-A")
                ->replyTo($data['email'])
                ->setBody($data['adminContent'], 'text/html')
                ->setSubject('A new get demo form submitted from website');
                $message->from('info@qi-a.com','Quality Institute of America');
            });
            
            // $adminEmail = $this->_sendMail("sales@qi-a.com", 'Quality Institute of America', $email, "sales@qi-a.com", "A new get demo form submitted from website", $data['adminContent']);

            echo json_encode(['status' => 1, 'message' => 'We will send you an email to your email address.']);
            exit();
        }
    }
    
    public function newsletter_request() {
        $email = request()->email;

        // check valid email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 0, 'message' => 'Invalid Email Address']);
            exit();
        }

        // check DNS
        // $domain = explode('@', $email);
        // if (!checkdnsrr($domain[1] , "MX")) {
        //     echo json_encode(['status' => 0, 'message' => 'Email Address is not Active']);
        //     exit();
        // }

        // check on database
        $find = NewsletterInformation::where('email', $email)->first();
        if($find) {
            echo json_encode(['status' => 0, 'message' => 'Your Email Address is already exist in our system. We will contact with you. Thank You']);
            exit();
        } else {
            $model = new NewsletterInformation;
            $model->email = $email;
            $model->save();
            
            $data['email'] = $email;

            $customerContent = get_option('client_newsletter_template');
            $adminContent = get_option('admin_newsletter_template');
            $customerContent = str_replace('[CLIENT_EMAIL]', $email, $customerContent);
            $adminContent = str_replace('[CLIENT_EMAIL]', $email, $adminContent);
            $data['customerContent'] = $customerContent;
            $data['adminContent'] = $adminContent;
            
            // Mail::send([], $data, function($message) use ($data) {
            //     $message->to($data['email'])
            //     ->replyTo("sales@qi-a.com", "QIA")
            //     ->setBody($data['customerContent'], 'text/html')
            //     ->setSubject('Thank you for requesting a Demonstration');
            //     $message->from('sales@qi-a.com','Quality Institute of America');
            // });
            
            Mail::send([], $data, function($message) use ($data) {
                $message->to($data['email'])
                ->replyTo("info@qi-a.com", "QIA")
                ->setBody($data['customerContent'], 'text/html')
                ->setSubject('Thank you for requesting a Demonstration');
                $message->from('info@qi-a.com','Quality Institute of America');
            });
            
            Mail::send([], $data, function($message) use ($data) {
                $message->to('info@qi-a.com', "QI-A")
                ->replyTo($data['email'])
                ->setBody($data['adminContent'], 'text/html')
                ->setSubject('A new newsletter form submitted from website');
                $message->from('info@qi-a.com','Quality Institute of America');
            });
            
            // $adminEmail = $this->_sendMail("sales@qi-a.com", 'Quality Institute of America', $email, "sales@qi-a.com", "A new newsletter form submitted from website", $data['adminContent']);

            echo json_encode(['status' => 1, 'message' => 'We will send you an email to your email address.']);
            exit();
        }
    }

    public function showBannerVideo() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $testimonial = Testimonial::where('id', $id)->first();
            return view('frontend.testimonial_video', compact('testimonial'));
        } else {
            $content = get_option('banner_video_url');
            return view('frontend.banner_video', compact('content'));
        }
    }
    
    public function search() {
        $searchText = $_GET['search'];
        $services = Service::where('slug', 'like', '%' . $searchText . '%')->orWhere('page_title', 'like', '%' . $searchText . '%')->orWhere('description', 'like', '%' . $searchText . '%')->get();

        $meta = new \stdClass();

        $meta->title = get_option('home_site_title') ? get_option('home_site_title') : 'QI-A';
        $meta->meta_title = get_option('meta_title') ? get_option('meta_title') : 'QI-A';
        $meta->meta_keyword = get_option('meta_keyword');
        $meta->article_tag = get_option('article_tag');
        $meta->meta_description = get_option('meta_description');
        
        return view('frontend.search_result', compact('services', 'searchText', 'meta'));

    }
    
    public function getEventCategory() {
        $id = $_GET['id'];

        $trainings = Training::where('category_id', $id)->where('status', 1)->where('archive', 0)->orderBy('event_date', 'ASC')->get();
        return view('frontend.get_training', compact('trainings'));
    }

    public function book_training($id) {
        $training = Training::where('id', $id)->first();
        return view('frontend.book_training', compact('training'));
    }

    public function submit_form(Request $request) {
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $phone = $request->phone;
        $training_id = $request->training_id;

        $model = new TrainingCandidate();
        $model->training_id = $training_id;
        $model->first_name = $first_name;
        $model->last_name = $last_name;
        $model->email = $email;
        $model->phone = $phone;
        $model->save();

        echo json_encode(['status' => 'success', 'message' => 'You are Successfully Registered.']);
    }

    public function dynamic($slug) {
        
        // Search on About
        $trainingContent = Training::where('slug', $slug)->first();
        if($trainingContent) {

            $meta = new \stdClass();

            $meta->title = $trainingContent->page_title ? $trainingContent->page_title : $trainingContent->site_title;
            $meta->meta_title = $trainingContent->meta_title;
            $meta->meta_keyword = $trainingContent->meta_keyword;
            $meta->article_tag = $trainingContent->article_tag;
            $meta->meta_description = $trainingContent->meta_description;

            return view('frontend.training_content', compact('trainingContent', 'meta'));
        }
        
        // Search on About
        $aboutContent = AboutUs::where('slug', $slug)->first();
        if($aboutContent) {

            $meta = new \stdClass();

            $meta->title = $aboutContent->page_title ? $aboutContent->page_title : $aboutContent->site_title;
            $meta->meta_title = $aboutContent->meta_title;
            $meta->meta_keyword = $aboutContent->meta_keyword;
            $meta->article_tag = $aboutContent->article_tag;
            $meta->meta_description = $aboutContent->meta_description;

            return view('frontend.about_content', compact('aboutContent', 'meta'));
        }

        // Search on Service
        $service = Service::where('slug', $slug)->first();
        if($service) {

            $meta = new \stdClass();

            $meta->title = $service->page_title ? $service->page_title : $service->site_title;
            $meta->meta_title = $service->meta_title;
            $meta->meta_keyword = $service->meta_keyword;
            $meta->article_tag = $service->article_tag;
            $meta->meta_description = $service->meta_description;

            if($service->category_id) {
                $relatedServices = Service::where('category_id', $service->category_id)->orderBy(DB::raw('RAND()'))->limit(10)->get();
            } else {
                $relatedServices = Service::orderBy(DB::raw('RAND()'))->limit(10)->get();
            }


            return view('frontend.service_details', compact('service', 'meta', 'relatedServices'));
        }

        // Search On Blog
        $blog = Blog::where('slug', $slug)->first();
        if($blog) {

            $meta = new \stdClass();

            $meta->title = $blog->site_title;
            $meta->meta_title = $blog->meta_title;
            $meta->meta_keyword = $blog->meta_keyword;
            $meta->article_tag = $blog->meta_article_tag;
            $meta->meta_script = $blog->meta_script;
            $meta->meta_description = $blog->meta_description;

            if($blog->category_id) {
                $relatedPosts = Blog::where('category_id', $blog->category_id)->orderBy(DB::raw('RAND()'))->limit(5)->get();
            } else {
                $relatedPosts = Blog::orderBy(DB::raw('RAND()'))->limit(5)->get();
            }
            $categories = BlogCategory::where('status', 1)->get();

            return view('frontend.blog_details', compact('blog', 'meta', 'relatedPosts', 'categories'));
        }

        // Search On News
        $blog = News::where('slug', $slug)->first();
        if($blog) {

            $meta = new \stdClass();

            $meta->title = $blog->site_title;
            $meta->meta_title = $blog->meta_title;
            $meta->meta_keyword = $blog->meta_keyword;
            $meta->article_tag = $blog->meta_article_tag;
            $meta->meta_script = $blog->meta_script;
            $meta->meta_description = $blog->meta_description;

            $relatedPosts = News::orderBy(DB::raw('RAND()'))->limit(5)->get();

            return view('frontend.news_details', compact('blog', 'meta', 'relatedPosts'));
        }

        // Search On Case Study
        $blog = MainCaseStudy::where('slug', $slug)->first();
        if($blog) {

            $meta = new \stdClass();

            $meta->title = $blog->site_title;
            $meta->meta_title = $blog->meta_title;
            $meta->meta_keyword = $blog->meta_keyword;
            $meta->article_tag = $blog->meta_article_tag;
            $meta->meta_script = $blog->meta_script;
            $meta->meta_description = $blog->meta_description;

            $relatedPosts = MainCaseStudy::orderBy(DB::raw('RAND()'))->limit(5)->get();

            return view('frontend.case_study_details', compact('blog', 'meta', 'relatedPosts'));
        }

        // Search on Blog Category
        $blogCategory = BlogCategory::where('slug', $slug)->where('status', 1)->first();
        if($blogCategory) {

            $meta = new \stdClass();

            $meta->title = $blogCategory->site_title;
            $meta->meta_title = $blogCategory->meta_title;
            $meta->meta_keyword = $blogCategory->meta_keyword;
            $meta->article_tag = $blogCategory->meta_article_tag;
            $meta->meta_script = $blogCategory->meta_script;
            $meta->meta_description = $blogCategory->meta_description;

            $blogs = Blog::where('category_id', $blogCategory->id)->where('status', 1)->where('is_archived', 0)->orderBy('id', 'DESC')->paginate(5);

            $relatedPosts = Blog::orderBy(DB::raw('RAND()'))->limit(5)->get();
            
            $categories = BlogCategory::where('status', 1)->get();
            $tags = BlogTag::where('status', 1)->where('is_archived', 0)->get();

            return view('frontend.blog_category_details', compact('blogCategory', 'blogs', 'meta', 'relatedPosts', 'categories', 'tags'));
        }

        // Search on Blog Tag
        $blogTag = BlogTag::where('slug', $slug)->where('status', 1)->where('is_archived', 0)->first();
        if($blogTag) {

            $meta = new \stdClass();

            $meta->title = $blogTag->site_title;
            $meta->meta_title = $blogTag->meta_title;
            $meta->meta_keyword = $blogTag->meta_keyword;
            $meta->article_tag = $blogTag->meta_article_tag;
            $meta->meta_script = $blogTag->meta_script;
            $meta->meta_description = $blogTag->meta_description;

            $blogs = Blog::where('tags', 'rlike', '(^|,)('. $blogTag->id .')(,|$)')->where('status', 1)->where('is_archived', 0)->orderBy('id', 'DESC')->paginate(5);

            $relatedPosts = Blog::orderBy(DB::raw('RAND()'))->limit(5)->get();
            
            $categories = BlogCategory::where('status', 1)->get();
            $tags = BlogTag::where('status', 1)->where('is_archived', 0)->get();

            return view('frontend.blog_tag_details', compact('blogTag', 'blogs', 'meta', 'relatedPosts', 'categories', 'tags'));
        }

        abort(404);
    }
}