<?php

namespace App\Http\Controllers;

use App\Models\Plantes;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PlantesController extends Controller
{

    use HttpResponses;

    public function index(Request $request)
    {

        $plantes = Plantes::all();
        return $this->success($plantes);
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'common_name' => 'required|string|max:255',
            'watering_general_benchmark' => 'required|string|max:255',


        ]);

        $plante = Plantes::create([
            'common_name' => $validatedData['common_name'],
            'watering_general_benchmark' => $validatedData['watering_general_benchmark'],

        ]);
        return $this->success($plante, 'plante créer avec succes', 201);

        $token = $plante->createToken('auth_token')->plainTextToken;

        return response()->json(['data' => $plante, 'access_token' => $token, 'token_type' => 'Bearer'], 201);
    }


    public function show($name)
    {

        $plant = Plantes::where('common_name', $name)->first();
        if (!$plant) {
            return $this->error(null, 'dégage pas de plante', 404);
        }
        return $this->success($plant, 'on la trouver ta plante');
    }


   public function destroy($id)
{

    $plante = Plantes::findOrFail($id); 
    $plante->delete(); 

    if(!$plante){
         return $this->error(null, 'plante pas supprimer', 404);
    }
    return $this->success($plante, 'plante supprimer');

}

}
