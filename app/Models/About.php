<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'name',
        'hero_title',
        'hero_subtitle',
        'about_eyebrow',
        'about_title',
        'about_description',
        'profile_image',
        'github_url',
        'linkedin_url',
    ];
}
