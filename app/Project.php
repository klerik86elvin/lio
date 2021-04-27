<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $with = ['department'];
    protected $hidden = ['department_id', 'created_at', 'deleted_at', 'updated_at'];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
