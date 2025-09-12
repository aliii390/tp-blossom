<?php

namespace App\Http\Controllers;

use App\Models\Plantes;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PlantesController extends Controller
{

    use HttpResponses;

   




        /**
 * @OA\Get(
 *     path="/plant",
 *     summary="Get a list of plants",
 *     tags={"Plantes"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */










    
    public function index(Request $request)
    {

        $plantes = Plantes::all();
        return $this->success($plantes);
    }


        /**
 * @OA\Post(
 *     path="/plant",
 *     summary="Create a new plant",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"common_name","watering_general_benchmark"},
 *             @OA\Property(property="common_name", type="string"),
 *             @OA\Property(property="watering_general_benchmark", type="array", @OA\Items(type="string"))
 *         )
 *     ),
 *     tags={"Plantes"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */

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

       /**
 * @OA\Get(
 *     path="/plant/{name}",
 *     summary="Get a specific plant by name",
 *     parameters={
 *         @OA\Parameter(name="name", in="path", required=true, @OA\Schema(type="string")),
 *     },
 *     tags={"Plantes"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=404, description="Plant not found")
 * )
 */

    public function show($name)
    {

        $plant = Plantes::where('common_name', $name)->first();
        if (!$plant) {
            return $this->error(null, 'dégage pas de plante', 404);
        }
        return $this->success($plant, 'on la trouver ta plante');
    }


                /**
 * @OA\Delete(
 *     path="/plant/{id}",
 *     summary="Delete a specific plant",
 *     parameters={
 *         @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     },
 *     tags={"Plantes"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=404, description="Plant not found")
 * )
 */

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
