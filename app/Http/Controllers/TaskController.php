<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Task;
use App\Models\Step;

class TaskController extends Controller
{
    public function liste_task()
    {
        $tasks = Task::all();
        return view('tasks.liste_task', compact('tasks'));
    }


    public function creer_task(Request $request, $id)
    {
        $step = Step::findOrFail($id);
        $tasks = $step->tasks;
        $tasks = Task::all();
        $steps = Step::all();
        // dd(8);
        return view('tasks.creer_task', compact('tasks', 'step','steps'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'step'=> 'required',
            'nom' => 'required',
            'description' => 'required',
        ]);

        $task = Task::create([
            'step_id' => $request->step,
            'nom_tache' => $request->nom,
            'description_tache' => $request->description,
        ]);


        return redirect()->route('tasks', $task->id)->with('success', 'tache ajoutée avec succès!');
    }



    public function details_task($id)
    {
        $tasks = Task::findOrFail($id);
        $task = $tasks;
        $step = Step::with('tasks')->findOrFail($id);
        // dd($step);
        return view('tasks.details_task', compact('tasks','step','task'));
    }

    

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks')->with('success', 'tache supprimée avec succès!');
    }


    



    






    public function modifier_task($id){

        $tasks = Task::find($id);
        return view('tasks.modifier_task', compact('tasks'));
       }
    
       public function modifier_task_traitement(Request $request, $id){
            $request->validate([
                'nom_tache'=>'required|max:20',
                'description_tache'=>'required|max:200',
            ]);
            $task = Task::find($request->id);
            
            $task->nom_tache = $request->input('nom_tache');
            $task->description_tache = $request->input('description_tache');
            $task->save();
            return redirect()->route('tasks', $task->id)->with('status', 'Modification effectuée avec succès'); 
       }
    


}