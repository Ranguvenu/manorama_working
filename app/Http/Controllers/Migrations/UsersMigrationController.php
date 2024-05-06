<?php

namespace App\Http\Controllers\Migrations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsersMigrationController extends Controller
{
    public function index()
    {
        return Inertia::render('Migrations/Users/index');
    }
}
