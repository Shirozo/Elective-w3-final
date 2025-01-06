<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Subcontent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicSubContentController extends Controller
{
    public function show($topic, $content, Request $request) {
        $contents = Subcontent::where("content_id", "=", $content)->get();

        $sidenav = "";


        return view("topicsubcontent", [
            "data" => $contents,
            "topic" => $topic,
            "content" => $content
        ]);
    }

    public function store(Request $request) {
        $data = Validator::make($request->all(), [
            "title" => "required|min:1",
            "content" => "required",
            "id" => "required"
        ]);

        if ($data->fails()) {
            return response()->json([
                "message" => "Validation Fails!"
            ], 403);
        }

        Subcontent::create([
            "title" => $request->title,
            "youtube_link1" => $request->v1,
            "youtube_link2" => $request->v2,
            "content" => $request->content,
            "content_id" => $request->id,
            "topic_id" => $request->t_id
        ]);

        return response()->json([
            "message" => "Content Added!"
        ], 200);
    }

    public function delete(Request $request)
    {
        if ($request->has("delete_id")) {

            $data = Subcontent::find($request->delete_id);

            if ($data != null) {

                $data->delete();

                return response()->json([
                    "message" => "Data Deleted!"
                ], 200);
            }

            return response()->json([
                "message" => "Data not found!"
            ], 403);
        }

        return response()->json([
            "message" => "ID is required"
        ], 404);
    }

    public function update(Request $request) {
        $data = Validator::make($request->all(), [
            "title" => "required|min:1",
            "content" => "required",
            "id" => "required"
        ]);

        if ($data->fails()) {
            return response()->json([
                "message" => "Validation Fails!",
                "f" => $data->failed()
            ], 403);
        }

        $instance = Subcontent::find($request->id);

        $instance->update([
            "title" => $request->title,
            "youtube_link1" => $request->youtube_link1,
            "youtube_link2" => $request->youtube_link2,
            "content" => $request->content,
        ]);

        return response()->json([
            "message" => "Content Updated!"
        ], 200);
    }

    public function api(Request $request) {
        if ($request->has("id")) {
            $data = Subcontent::find($request->id);
    
            if ($data) {
                return response()->json([
                    "message" => "Data found!",
                    "data" => $data
                ], 200);
            }
    
            return response()->json([
                "message" => "Data not found!"
            ], 404);
        }
    
        return response()->json([
            "message" => "ID is required"
        ], 400);
    }
    
}
