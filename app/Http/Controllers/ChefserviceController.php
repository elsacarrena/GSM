<?php

namespace App\Http\Controllers;
use App\Models\Chefservice;
use Illuminate\Http\Request;



    class ChefserviceController extends Controller
    {

        // Ajout du middleware 'Chef service' au constructeur
        public function __construct()
        {
            $this->middleware('chefservice');
        }

        public function create(){
            return view('chef_service.create');
        }

        public function index()
        {
            $chefs = Chefservice::all();
            return view('chef_service.index', compact('chefs'));
        }

        public function store(Request $request)
        {
            $request->validate([
                'nom' => 'required',
                'numero' => 'required',
                'domaine' => 'required',
                'localisation' => 'required',
                'numero_urgence' => 'required',
            ]);

            Chefservice::create($request->all());


                return redirect()->route('chef_service.index')->with('success', 'Membre ajouté avec succès!');
            
        }

        public function edit($id){
            $chef = Chefservice::findOrFail($id);
            return view('chef_service.edit', compact('chef'));
        }

        public function update(Request $request, $id)
        {
            $request->validate([
                'nom' => 'required|string',
                'numero' => 'required|string',
                'domaine' => 'required|string',
                'localisation' => 'required|string',
                'numero_urgence' => 'required|string',
            ]);

            $chef = Chefservice::findOrFail($id);
            $chef->update($request->all());

            return redirect()->route('chef_service.index')->with('success', 'Membre modifié avec succès!');
        }

        public function destroy($id)
        {
            $chef = Chefservice::findOrFail($id);
            $chef->delete();

            return redirect()->route('chef_service.index')->with('success', 'Membre supprimé avec succès');
        }
    }

