<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingModel;
use Google_Client;
use Google_Service_YouTube;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class videoController extends Controller
{
    private $pathViewController = 'admin.pages.video.';
    private $controllerName = 'video';
    private $params = [];

    public function __construct()
    {
        //lay setting general
        $this->model=new SettingModel();
        $this->setting_social=$this->model->getItem(null,['task'=>'social']);
        View::share(['controllerName'=> $this->controllerName,'youtube'=>$this->setting_social['youtube']]);

    }

    public function index()
    {
        $htmlBody=$this->post($this->setting_social['youtube']);
        return view($this->pathViewController . 'detail',compact('htmlBody'));

    }

    public function post($url="")
    {
        if(empty($url)){
            $url=$_POST['url'];
        }
        $this->model->saveItem(['youtube'=>$url],['task'=>'social']);



        $url=explode("&",$url)[1];

        $string = substr($url,strpos($url,"&list=")+5);
//        dd($string);


        $client = new Google_Client();
        $client->setDeveloperKey('AIzaSyAo1OcB4i5jF2pDVFCX-TzSXM0rOlzaqTs');
        $youtube = new Google_Service_YouTube($client);


        $htmlBody = '<div class="row">';


        $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems('snippet', array(
            'playlistId' => $string,
            'maxResults' => 10));


        foreach ($playlistItemsResponse['items'] as $playlistItem) {

            $htmlBody .= sprintf('<div class="col-md-4 mb-5"><iframe width="330" height="160" src="https://www.youtube.com/embed/%s"
             title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write;
             encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            ',  $playlistItem['snippet']['resourceId']['videoId']);
        }




        $htmlBody .= '</div>';
        return view($this->pathViewController . 'detail',compact('htmlBody'));

    }
}
