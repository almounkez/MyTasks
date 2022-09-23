<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
     protected $fillable = [
            'user_id',
            'project_name',
            'task_amount',
            'task_duedate',
            'task_description',
            'task_eval',
            'task_finished'];

            /**
             * Get the user that owns the tasks
             *
             * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
             */
            public function user()
            {
                return $this->belongsTo(User::class, 'user_id', 'id');
            }
}
