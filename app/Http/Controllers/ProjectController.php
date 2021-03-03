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

            $data = Project::all();
    
            return $data;   

    }


}

