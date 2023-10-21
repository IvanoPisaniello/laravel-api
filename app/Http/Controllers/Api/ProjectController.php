<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        //con il paginate vado a fare una request la cui risposta sarà soltanto di 3 elementi per pagina
        $projects = Project::with('type', 'technologies')->paginate(3);

        return response()->json([
            "message" => "lista progetti",
            "results" => $projects,
        ]);
    }

    public function show($slug)
    {
        $project = Project::where("slug", $slug)
            ->with(['type', 'technologies'])
            ->first();

        return response()->json($project);
    }
}
