<?php

namespace App\Http\Controllers\News;

use App\Http\Requests\ContactRequest;
use App\Mail\MailService;
use App\Models\SettingModel;
use Illuminate\Database\Eloquent\Model;
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
             'phone' => $request->phone,

         ];

         $this->model->saveItem($data, ['task' => 'news-add-item']);

         $mailService = new MailService();
         $mailService->sendContactInfo($data);

        return redirect()->back()->with('notify', 'Cảm ơn bạn đã gửi thông tin liên hệ. Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất.');
    }

    public function map()
    {
        //lay setting general
        $settingModel=new SettingModel();
        $setting_general=$settingModel->getItem(null,['task'=>'general']);
        return response()->json([
            'map'=>$setting_general['map']
        ]);
    }
}
