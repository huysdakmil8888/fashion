<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Google_Client;
use Google_Service_YouTube;
use http\Env\Request;
use Illuminate\Support\Facades\View;

class videoController extends Controller
{
    private $pathViewController = 'admin.pages.video.';
    private $controllerName = 'video';
    private $params = [];

    public function __construct()
    {
        View::share('controllerName', $this->controllerName);
    }

    public function index()
    {
        return view($this->pathViewController . 'index',['htmlBody'=>'']);
    }

    public function post(\Illuminate\Http\Request $request)
    {
        $url=$_POST['url'];
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

            $htmlBody .= sprintf('<div class="col-md-4"><iframe width="290" height="150" src="https://www.youtube.com/embed/%s"
             title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write;
             encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            ',  $playlistItem['snippet']['resourceId']['videoId']);
        }




        $htmlBody .= '</div>';
        return view($this->pathViewController . 'index',compact('htmlBody'));

    }
}
