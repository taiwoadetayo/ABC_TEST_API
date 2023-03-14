<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Sentinel;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Log;

class NewsController extends Controller
{

    // pull news from hackers and store in mysql
    public function pullNews(){

        $client = new Client();
        $url    = env('MIDDLEWARE_URL').'/jobstories.json';
        $res    = Http::withoutVerifying()->get($url);
        $result   = json_decode($res->getBody());

        if ($result){
            foreach ($result as $key => $id) {    
                $newsurl = env('MIDDLEWARE_URL').'/item/'.$id.'.json';
                $res    = Http::withoutVerifying()->get($newsurl);
                $res   = json_decode($res->getBody());

                DB::insert("INSERT INTO newsfeeds (id, username, score, time, title, type, text, url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", [$res->id, $res->by, $res->score, $res->time, $res->title, $res->type, isset($res->text) ? $res->text : '', isset($res->url) ? $res->url : '' ]);

            }

            return response(['mesage'=>$res,'status' => true],200);
        }
        else{
            return response(['status' => false],400);
        }

    }

    public function getFeeds(){
        $feeds = DB::select("SELECT * FROM newsfeeds");

        return response(['data' => $feeds,'count'=>count($feeds), 'status' => true]);

    }

}
