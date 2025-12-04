<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): Response
    {
        $users = User::query()
            ->select(['id', 'name', 'email', 'role', 'created_at'])
            ->where('role', User::ROLE_USER)
            ->latest('created_at')
            ->get();

        return Inertia::render('Admin/Dashboard', [
            'users' => $users,
        ]);
    }
}
