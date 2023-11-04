<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectUser extends Model
{
    use HasFactory;
    protected $table = 'project_user';
    protected $fillable = ['project_id', 'user_id', 'start_date'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
