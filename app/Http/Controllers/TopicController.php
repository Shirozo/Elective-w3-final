<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{

    public function show(Request $request)
    {

        // Kuhaa tanan nga topic ha db
        $topic = Topic::all();

        // Render an html together han data
        return view("admin", [
            "topic" => $topic
        ]);
    }

    public function store(Request $request)
    {

        // Check kun mayda name ha request
        if ($request->has("name")) {

            // Add ha db kun mayda
            Topic::create([
                "name" => $request->name,
            ]);

            // Return 200 means OK
            return response()->json([
                "message" => "New Topic Added!"
            ], 200);
        }

        // Return 404 pag wara name
        return response()->json([
            "message" => "Name is required!"
        ], 404);
    }

    public function delete(Request $request)
    {
        if ($request->has("delete_id")) {

            $data = Topic::find($request->delete_id);

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

    public function update(Request $request)
    {
        if ($request->has("update_id") && $request->has("name")) {

            $data = Topic::find($request->update_id);

            if ($data != null) {

                $data->update([
                    "name" => $request->name
                ]);

                return response()->json([
                    "message" => "Data Updated!"
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

    
}
