<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Poisson;
use App\Models\Step;

class PoissonController extends Controller
{
    public function liste_poisson()
    {
        $poissons = Poisson::all();
        return view('poissons.liste_poisson', compact('poissons'));
    }

    public function creer_poisson()
    {
        $steps = Step::all();
        return view('poissons.creer_poisson', compact('steps'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif', 
        ]);

        if($request->hasfile('image'))
        {
            $file = $request->file("image");
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/poissons/', $filename);
            $image ='uploads/poissons/' .$filename;
        }

        $poisson = Poisson::create([
            'nom_poisson' => $request->nom,
            'description_poisson' => $request->description,
            'image_poisson' => $image, 
        ]);


        return redirect()->route('poissons', $poisson->id)->with('success', 'poisson ajoutée avec succès!');
    }

    public function details_poisson($id)
    {
        $poisson = Poisson::findOrFail($id);
        $steps = Step::where('poisson_id', $id)->with('poissons')->get();

        return view('poissons.details_poisson', compact('steps','poisson'));
    }

    

    public function destroy($id)
    {
        $poisson = Poisson::findOrFail($id);
        $poisson->delete();

        return redirect()->route('poissons')->with('success', 'Poisson supprimée avec succès!');
    }

    public function steps ($id) {

        $steps = Step::where('column_name', $id)->get();
        

    }
    

    public function modifier_poisson($id){

        $poissons = Poisson::find($id);
        return view('poissons.modifier_poisson', compact('poissons'));
       }
    
       public function modifier_poisson_traitement(Request $request, $id){
            $request->validate([
                'nom_poisson'=>'required|max:20',
                'description_poisson'=>'required|max:200',
            ]);
            $poisson = Poisson::find($request->id);
            
            $poisson->nom_poisson = $request->input('nom_poisson');
            $poisson->description_poisson = $request->input('description_poisson');
            $poisson->save();
            return redirect()->route('poissons', $poisson->id)->with('status', 'Modification effectuée avec succès');
       }
    
}