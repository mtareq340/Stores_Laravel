<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['title'];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }
    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
  
    
}
