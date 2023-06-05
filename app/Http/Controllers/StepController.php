<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Task;
use App\Models\Step;
use App\Models\Poisson;

class StepController extends Controller
{

    
    public function liste_step()
    {
        $steps = Step::all();
        return view('steps.liste_step', compact('steps'));
    }


    public function creer_step(Request $request, $id)
    {
        $poisson = Poisson::findOrFail($id);
        
        $steps = $poisson->steps;
        $poissons = Poisson::all();
        
        return view('steps.creer_step', compact('steps','poissons'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'poisson' => 'required',
            'nom' => 'required',
            'description' => 'required',
            'date_debut_etape' => 'required',
            'date_fin_etape' => 'required',
            'duree_etape' => 'required',

        ]);

        $step = Step::create([
            'poisson_id' => $request->poisson,
            'nom_etape' => $request->nom,
            'description_etape' => $request->description,
            'date_debut_etape' => $request->date_debut_etape,
            'date_fin_etape' => $request->date_fin_etape,
            'duree_etape' => $request->duree_etape,
        ]);


        return redirect()->back()->with('success', 'Étape créée avec succès pour la poisson ');
    }

    public function details_step($id)
    {
        $step = Step::findOrFail($id);
        $poisson = Poisson::with('steps')->findOrFail($id);
        return view('steps.details_step', compact('step'));
    }

    

    public function destroy($id)
    {
        $step = Step::findOrFail($id);
        $step->delete();

        return redirect('details_poisson')->with('success', 'etape supprimée avec succès!');
    }


    public function modifier_step($id){

        $steps = Step::find($id);
        return view('steps.modifier_step', compact('steps'));
       }
    
       public function modifier_step_traitement(Request $request, $id){
            $request->validate([
                'poisson' => 'required',
                'nom' => 'required',
                'description' => 'required',
                'date_debut_etape' => 'required',
                'date_fin_etape' => 'required',
                'duree_etape' => 'required',
            ]);
            $step = Step::find($request->id);
                
                $step->poisson_id = $request->input('poisson');
                $step->nom_etape = $request->input('nom_etape');
                $step->description_etape = $request->input('descriptionetape');
                $step->date_debut_etape = $request->input('date_debut_etape');
                $step->date_fin_etape = $request->input('date_fin_etape');
                $step->duree_etape = $request->input('duree_etape');
            $step->save();
            return redirect()->route('steps', $step->id)->with('status', 'Modification effectuée avec succès');
       }

}