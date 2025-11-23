<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description',
        'last_update_by',
    ];  

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class, 'project_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            ProjectCategory::class,
            'project_category_assignments',
            'project_id',
            'category_id'
        );
    }

    public function lastUpdatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'last_updated_by');
    }
}
