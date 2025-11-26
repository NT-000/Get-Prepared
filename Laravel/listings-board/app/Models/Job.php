<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    protected $fillable = ['title', 'description', 'salary', 'tags', 'job_type', 'remote', 'requirements',
        'benefits', 'city', 'country', 'address', 'zipcode', 'contact_email', 'contact_phone',
        'company_website', 'company_name', 'company_description', 'company_logo', 'user_id'];

    //relation to user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookmarkedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'job_user_bookmarks', 'job_id', 'user_id')->withTimestamps();
    }

    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class, 'job_id');
    }

    
}
