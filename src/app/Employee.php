<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Employee extends Model
{
	use NodeTrait;
	
	public $fillable = ['fio','position','salary'];
}
