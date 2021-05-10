<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['text', 'employee_id'];

    protected $appends = ['emp'];


    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getEmpAttribute()
    {
        return $this->employee()->first();
    }
}
