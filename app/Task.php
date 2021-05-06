<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'text', 'deadline', 'created_by', 'assigned_to','project_id', 'status_id'];

    protected $dates = ['deadline'];

    protected $casts = [
        'deadline' => 'date:d-m-y',
    ];
//    protected $hidden = [
//        'created_by','assigned_to','deleted_at','updated_at'
//    ];


    public function createdBy()
    {
        return $this->belongsTo(Employee::class, 'id', 'created_by');
    }

    public function assignedTo()
    {
        return $this->belongsTo(Employee::class, 'id', 'assigned_to');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
