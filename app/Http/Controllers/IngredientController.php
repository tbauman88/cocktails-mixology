<?php

namespace App\Http\Controllers;

use App\Http\Resources\IngredientResource;
use App\Models\Ingredient;
use Illuminate\Http\JsonResponse;

class IngredientController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(IngredientResource::collection(Ingredient::all()));
    }
}
