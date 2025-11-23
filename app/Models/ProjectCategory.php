<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProjectCategory extends Model
{
    use HasFactory;

    protected $table = 'project_categories';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'project_category_assignments',
            'category_id',
            'project_id'
        );
    }
}
