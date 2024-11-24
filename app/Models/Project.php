<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $fillable = ['title', 'description'];

    // path function
    public function path()
    {
        return "/projects/{$this->id}";
    }
}
