<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    protected $fillable = ['title', 'description', 'salary', 'tags', 'job_type', 'remote', 'requirements',
        'benefits', 'city', 'country', 'address', 'zipcode', 'contact_email', 'contact_phone',
        'contact_website', 'company_name', 'company_description', 'company_logo', 'user_id'];

    //relation to user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
