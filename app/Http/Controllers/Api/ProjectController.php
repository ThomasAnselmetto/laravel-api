<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // nel with dico di non darmi solo l'id sul front ma avro' il type e technology
        // per non scriverlo tutte le volte(lazy loading) posso andare nel model e usare eager loading(ma appesantisce la richiesta)
        // volendo si possono combinare es type lazy e technologies con eager e viceversa

        // $projects = Project::select('description') es di invio con restrizione alle description della api
        // se voglio le technologies mi serve prendere l'id nella select
        $projects = Project::where('published',true)
        ->with('type','technologies')
        ->orderBy('updated_at', 'DESC')
        ->paginate(6);

        // invio direttamente l'array senza creare un array associativo e non devo usare il .projects in js
        // foreach($projects as $project){
        //     $project->description = $project->getAbstract(200);
        //   }

        return response()->json($projects);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // la dipendence injection non c'e' qui  prevede un findorfile
    public function show($id)
    {
        $project = Project::where('id',$id)
        ->with('type','technologies')->first();

        if(!$project) return response(null, 404);
        return response()->json($project);
    }
    // se non ho questo project dammi page404 senno dammi il dettaglio del project
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}