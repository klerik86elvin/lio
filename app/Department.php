<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
