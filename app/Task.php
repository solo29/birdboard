<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //

    protected $casts = [
        'completed' => 'boolean'
    ];

    protected $guarded = [];

    protected $touches = ['project'];


    public function project()
    {

        return $this->belongsTo(Project::class);
    }

    public function complete()
    {
        $this->update(['completed' => true]);

        $this->project->recordActivity('completed_task');
    }

    public function inComplete()
    {
        $this->update(['completed' => false]);

        $this->project->recordActivity('incompleted_task');
    }

    public function path()
    {
        //return $this->project->path() . '/tasks/' . $this->id;
        return '/projects/' . $this->project->id . '/tasks/' . $this->id;
    }
}
