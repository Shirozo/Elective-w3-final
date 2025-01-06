<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicContentController extends Controller
{
    public function show(Request $request) {
        $contents = Content::where("topic_id", "=", $request->q)->get();

        return view("topiccontent", [
            "data" => $contents,
            "id" => $request->q
        ]);
    }

    public function store(Request $request) {
        $data = Validator::make($request->all(), [
            "title" => "required|min:1",
            "id" => "required"
        ]);

        if ($data->fails()) {
            return response()->json([
                "message" => "Validation Fails!"
            ], 403);
        }

        Content::create([
            "title" => $request->title,
            "topic_id" => $request->id
        ]);

        return response()->json([
            "message" => "Content Added!"
        ], 200);
    }

    public function delete(Request $request)
    {
        if ($request->has("delete_id")) {

            $data = Content::find($request->delete_id);

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
            "id" => "required"
        ]);

        if ($data->fails()) {
            return response()->json([
                "message" => "Validation Fails!",
                "f" => $data->failed()
            ], 403);
        }

        $instance = Content::find($request->id);

        $instance->update([
            "title" => $request->title,
        ]);

        return response()->json([
            "message" => "Content Updated!"
        ], 200);
    }

    public function api(Request $request) {
        if ($request->has("id")) {
            $data = Content::find($request->id);
    
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
