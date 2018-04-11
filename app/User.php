<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends model
    {
        protected $hidden= [
          'password'
        ];
    }
