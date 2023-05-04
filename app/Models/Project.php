<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory,SoftDeletes;

    // metto type e non types perche' i tipo possono avere piu' progetti ma ogni progetto ha un solo tipo
    
    // * Ora abbiamo accesso alla sintassi del tipo $post->category oppure $category->posts
    
    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

    public function getAbstract($max = 100) {
        return substr($this->description, 0 , $max) . "...";
    }
    // mutators per centralizzare caricamento immagini
    public function getImageUri()
    {
        return $this->project_preview_img ? asset('storage/' . $this->project_preview_img) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQsViab5VIcW3FrUIYfgvVmuDJrbpMna6Gn742EnMJtopVO_IKFbOD496Bry2Tz4_6jfrk&usqp=CAU';
    }

    protected $fillable = ["project_preview_img",
    "name","commits",
    "contributors",
    "description","type_id","published"];
    
    // eager loading
    // protected $with = ['type','technologies']

// ci creiamo la nostra funzione per la logica di creazione dello slug
    public static function generateSlug($name){

        $possible_slug = Str::of($name)->slug('-'); 
        // controllo che sia unico senno ciclo
        $projects = Project::where('slug',$possible_slug)->get();

        $original_slug = $possible_slug;

        $i = 2;
        // usiamo il count al posto di !empty per non finire in un loop infinito
        while (count($projects)){
            $possible_slug = $original_slug . "-" . $i;
            $projects = Project::where('slug',$possible_slug)->get();
            $i++;
        }

        return $possible_slug;

    }
    
    // MUTATORS
    protected function getUpdatedAtAttribute($value){
        Carbon::setLocale('en');
        $date_from = Carbon::create($value);
        $date_now = Carbon::now();
        return str_replace('before','ago' , $diff_in_minutes = $date_from->diffForHumans($date_now));
    }
    // return $diff_in_minutes = Carbon::create($value)->diffForHumans(Carbon::now()); stessa cosa ma su una unica linea
    protected function getCreatedAtAttribute($value){
        Carbon::setLocale('en');
        $date_from = Carbon::create($value);
        $date_now = Carbon::now();
        return str_replace('before','ago' , $diff_in_minutes = $date_from->diffForHumans($date_now));

    }
        

    // questo tradotto sarebbe (trovami tutti i projects dove lo slug e' uguale allo slug che ho appena generato)
}