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
                "name" => $request->name
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
}
