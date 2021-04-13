<?php

namespace App\Http\Controllers\News;

use App\Http\Requests\ContactRequest;
use App\Mail\MailService;
use Illuminate\Support\Facades\View;
use App\Models\ContactModel as MainModel;

class ContactController extends NewsController
{
    private $pathViewController = 'news.pages.contact.';
    private $controllerName = 'contact';

    public function __construct()
    {
        $this->model = new MainModel();
        View::share('controllerName', $this->controllerName);
        parent::__construct();
    }

    public function index()
    {
        return view($this->pathViewController . 'index');
    }

    public function contact(ContactRequest $request)
    {
         $data = [
             'name' => $request->name,
             'email' => $request->email,
             'message' => $request->message,
         ];

         $this->model->saveItem($data, ['task' => 'news-add-item']);

         $mailService = new MailService();
//         $mailService->sendContactConfirm($data);
         $mailService->sendContactInfo($data);

        return redirect()->back()->with('notify', 'Cảm ơn bạn đã gửi thông tin liên hệ. Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất.');
    }

    public function thank_you()
    {
        return view($this->pathViewController . 'thank_you');
    }
}
