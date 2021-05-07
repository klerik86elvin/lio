<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'updated_at'];

//    protected $with = ['tasks'];

    public function tasks($project = null)
    {
        return $this->hasMany(Task::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function toArray(){
        return [
            'id' => $this->id,
            'name' => $this->name,
//            'project_id' => $this->pivot->project_id,
            'tasks' => $this->tasks()->where('project_id', @$this->pivot->project_id)->get()
        ];
    }
}
