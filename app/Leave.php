<?php

namespace App;
use Gbrock\Table\Traits\Sortable;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
  use Sortable;

    /**
     * The attributes which may be used for sorting dynamically.
     *
     * @var array
     */
    protected $sortable = ['id', 'subordinate_id','substitute_id'];
    //
}
