<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
   protected $fillable = ['question_id','answer', 'created_by', 'updated_by'];
}
