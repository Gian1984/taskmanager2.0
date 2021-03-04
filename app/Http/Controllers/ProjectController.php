<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function addProject(Request $request ){

        $request->validate([
            'name'=>['required'],
            'title'=>['required'],
            'content'=>['required'],
            'date'=>['required'],
            'status'=>['required'],
            
        ]);

        Project::create([

            'name'=>$request->name,
            'title'=>$request->title,
            'content'=>$request->content,
            'date'=>$request->date,
            'status'=>$request->status,
            
        ]);

    }

    public function getProject(){

            $project = Project::all();
    
            return $project;   

    }

    public function update(Request $request, $id){

    
        Project::where('id', $id)->update(array('status' => $request->status));
        
    }

    public function destroy($id)
    {
        return Project::findOrFail($id)->delete();
    }


    //  create resource f a contreller example:
    //  Route::resource('photos', PhotoController::class);
    // guide at : https://laravel.com/docs/8.x/controllers#resource-controllers
    // crea automaticamente delle route predefinite che posso vedere con il comando:
    // php artisan route:list
}

