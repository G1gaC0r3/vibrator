<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function index()
{

    $posts = Post::latest()->paginate(5);
	
}
    use HasFactory;
}
