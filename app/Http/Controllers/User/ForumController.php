<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Forum;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::with('user')->orderBy('tanggal', 'desc')->get();
        return view('user.forum.index', compact('forums'));
    }
}
