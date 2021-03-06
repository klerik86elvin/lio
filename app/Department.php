<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $with = ['projects','employees'];
    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];
    public function projects()
    {
        return $this->hasMany(Project::class);
    }


    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
