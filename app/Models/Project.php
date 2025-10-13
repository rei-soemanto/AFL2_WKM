<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the images for the project.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class, 'project_id');
    }

    public $timestamps = false;

    /**
     * The categories that belong to the project.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            ProjectCategory::class,
            'project_category_assignments',
            'project_id',
            'category_id'
        );
    }
}
