<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Subcontent;
use App\Models\Topic;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function content()
    {

        $topic = Topic::all();

        return view("landing", [
            "topics" => $topic
        ]);
    }

    public function topicShow(Request $request)
    {
        $contents = Content::where("topic_id", "=", $request->id)->get();

        $sidenav = "";

        foreach ($contents as $c) {
            $subcontent = Subcontent::where("content_id", "=", $c->id)->get();
            $sidenav .= '<h2 id="title">' . $c->title . '</h2><div class="topic-content">';

            foreach ($subcontent as $s) {
                $sidenav .= "<a href='" . route('t_show') . "?id=$request->id&c_id=$c->id' class='content-title'>$s->title</a>";
            }

            $sidenav .= "</div>";
        }
        
        $topic = Topic::all();
        $main_topic = Topic::find($request->id);
        $content = Content::where("topic_id", "=", $request->id)->get();

        $content_main = null;
        $previousContent = null;
        $nextContent = null;

        if ($request->has("c_id")) {
            $content_main = Content::find($request->c_id);
            $previousContent = Content::where("topic_id", "=", $request->id)
                ->where("id", "<", $content_main->id)
                ->orderBy("id", "desc")
                ->first();

            $nextContent = Content::where("topic_id", "=", $request->id)
                ->where("id", ">", $content_main->id)
                ->orderBy("id", "asc")
                ->first();
        }

        return view("content", [
            "sidenav" => $sidenav,
            "topic" => $topic,
            "main_topic" => $main_topic,
            "content" => $content,
            "content_main" => $content_main,
            "t_id" => $request->id,
            "previousContent" => $previousContent,
            "nextContent" => $nextContent
        ]);
    }
}
