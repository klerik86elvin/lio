<?php

namespace App\Observers;

use App\Project;
use App\Status;

class ProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        $project->statuses()->createMany([
            ['name' => 'Open', 'color' => 'rgb(152, 170, 179)'],
            ['name' => 'In Progress', 'color' => 'rgb(0, 170, 255)'],
            ['name' => 'done', 'color' => 'rgb(71, 204, 138)'],
            ['name' => 'Layihəyə aid olan sənədlər', 'color' => 'rgb(48, 191, 191)']
        ]);
    }

    /**
     * Handle the project "updated" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        //
    }

    /**
     * Handle the project "deleted" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function deleted(Project $project)
    {
        //
    }

    /**
     * Handle the project "restored" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function restored(Project $project)
    {
        //
    }

    /**
     * Handle the project "force deleted" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function forceDeleted(Project $project)
    {
        //
    }
}
