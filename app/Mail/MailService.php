<?php
namespace App\Mail;

use App\Models\SettingModel;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Template;

class MailService
{
    private $fromTitle;

    public function __construct()
    {
        $this->fromTitle = 'Fashion Madura for kids';
    }

    public function sendContactConfirm($data)
    {
        $mail = json_decode(SettingModel::where('key_value', 'setting-email')->first()->value, true);

        if (empty($mail))
            return false;
        else {
            Mail::send([], [], function ($message) use ($mail, $data) {
                $message->from($mail['username'], $this->fromTitle);
                $message->to($data['email']);
                $message->subject($this->fromTitle . ' Thông báo gửi liên hệ thành công');

                $content = sprintf('
                <p>Xin chào, %s</p>
                <p>Jadusona đã nhận được thông tin liên hệ từ bạn và sẽ phản hồi bạn trong thời gian sớm nhất</p>
                <p>Cảm ơn!</p>
                ', $data['name']);
                $message->setBody($content, 'text/html');
            });
            return true;
        }
    }

    public function sendContactInfo($data)
    {
        $mail = json_decode(SettingModel::where('key_value', 'setting-email')->first()->value, true);
        if (empty($mail))
            return false;
        else {
            Mail::send([], [], function ($message) use ($mail, $data) {
                $message->from($mail['email'], $this->fromTitle);
                $message->to($data['email']);

                $bcc = explode(',', SettingModel::where('key_value', 'setting-bcc')->first()->value);
                $message->bcc($bcc);

                $message->subject('Thông tin liên hệ từ ' . $data['name']);
                $content = sprintf('
                <p>Name: %s</p>
                <p>Email: %s</p>
                <p>Message: %s</p>
                ', $data['name'], $data['email'], $data['message']);
                $message->setBody($content, 'text/html');
            });
            return true;
        }
    }

    // Mailer::sendContactConfirm($data);
    // Mailer::sendContactInfo($data);
}