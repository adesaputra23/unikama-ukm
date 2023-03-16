<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table        = 'role_table';
    protected $primaryKey   = 'id_role';
    protected $keyType      = 'int';
    public $incrementing    = false;
}
