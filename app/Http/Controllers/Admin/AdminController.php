<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $adminUser = User::findOrFail(Auth::user()->id);
        return view('admin.index', compact('adminUser'));
    }
}
