<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Http\Resources\AnimalResource;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of animals as JSON for authenticated users.
     */
    public function index(Request $request)
    {
        // Allow optional filtering by species via query param ?species=chat|chien|oiseau
        $query = Animal::query();

        // Accept either ?species=.. or ?type=.. from the frontend; database stores the value in `type`.
        $filter = $request->query('species') ?? $request->query('type');
        if (!empty($filter) && $filter !== 'all') {
            // case-insensitive match on `type` column (avoid DB-specific backticks)
            $query->whereRaw('LOWER(type) = ?', [strtolower($filter)]);
        }

        $animals = $query->get();

        return AnimalResource::collection($animals);
    }
}
