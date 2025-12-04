<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function destroy(User $user): JsonResponse
    {
        if ($user->role !== User::ROLE_USER) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, __('Impossible de supprimer un administrateur.'));
        }

        $user->delete();

        return new JsonResponse([
            'message' => __('Utilisateur supprimé avec succès.'),
        ]);
    }
}

