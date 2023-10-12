<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;
use Illuminate\Support\Str;
use App\Http\Requests\ProjectUpsertRequest;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view("admin.projects.index", compact('projects'));
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->first();

        return view('admin.projects.show', compact('project'));
    }

    public function create()
    {

        $types = Type::all();
        return view('admin.projects.create', ['types' => $types]);
    }


    public function edit($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }



    public function update(ProjectUpsertRequest $request, $slug)
    {


        $data = $request->validated();
        $project = Project::where('slug', $slug)->firstOrFail();
        if (key_exists("image", $data)) {
            // carico il nuovo file
            // salvo in una variabile temporanea il percorso del nuovo file
            $data['image'] = Storage::put('projects', $data['image']);

            // Dopo aver caricato la nuova immagine, PRIMA di aggiornare il db,
            // cancelliamo dallo storage il vecchio file.
            // $post->cover_img // vecchio file
            Storage::delete($project->image);
        }

        $project->update($data);

        return redirect()->route('admin.projects.show', $project->slug);
    }


    public function store(ProjectUpsertRequest $request)
    {
        $data = $request->validated();
        $data['image'] = Storage::put('projects', $data['image']);


        $counter = 0;



        do {
            // creo uno slug e se il counte e maggiore di 0, concateno il counter
            $slug = Str::slug($data["title"]) . ($counter > 0 ? "-" . $counter : "");

            // cerco se esiste gia un elemento con questo slug
            $alreadyExists = Project::where("slug", $slug)->first();

            $counter++;
        } while ($alreadyExists); // ripeto il ciclo finche esiste gia un elemento con questo slug aggiungendo -$counter

        $data["slug"] = Str::slug($data["title"]);
        $data["languages_used"] = explode(",", $data["languages_used"]);

        $project = Project::create($data);
        return redirect()->route('admin.projects.show', $project->slug);
    }

    public function destroy($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        if ($project->image) {
            Storage::delete($project->image);
        }


        // Effettua l'eliminazione del progetto
        $project->delete();

        // Reindirizzo l'utente alla lista dei progetti 
        return redirect()->route('admin.projects.index');
    }
}
