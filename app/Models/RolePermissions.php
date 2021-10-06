<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermissions extends Model
{
    use HasFactory;

    
    protected $table 		= 'roles_permissions';
    protected $primaryKey 	= 'id';


    public function pilot_role()
    {
        return $this->belongsTo(PilotRoles::class,'pilot_role_id');
    }

    
    public function getRoleNameAttribute()
    {
        return $this->pilot_role->name;
    }

    
}
