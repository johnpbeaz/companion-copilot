<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prompt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prompt_text',
        'json_output',
        'explanation',
    ];
}
