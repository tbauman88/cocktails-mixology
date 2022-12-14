<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDrinkRequest;
use App\Http\Resources\DrinkResource;
use App\Models\Drink;
use App\Models\Ingredient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(DrinkResource::collection(Drink::all()));
    }

    public function store(StoreDrinkRequest $request): JsonResponse
    {
        $request->validated();

        $drink = Drink::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'owner' => $request->input('user'),
            'published' => $request->input('published') ?: false,
        ]);

        $drink->save();

        foreach ($request->input('ingredients') as $item) {
            $ingredient = Ingredient::firstOrCreate(["name" => $item["name"]]);

            $created = [
                "drink_id" => $drink->id,
                "ingredient_id" => $ingredient->id,
                "amount" => $item["amount"],
                "amount_unit" => $item["unit"]
            ];

            $drink->ingredients()->attach([$created]);
        }

        return response()->json(DrinkResource::make($drink), JsonResponse::HTTP_CREATED);
    }
}
