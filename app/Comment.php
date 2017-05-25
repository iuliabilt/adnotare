<?php

namespace Adnotare;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent;

class Comment extends Eloquent { 
// let eloquent know that these attributes will be available for mass assignment protected 
	$fillable = array('author', 'text'); 

}