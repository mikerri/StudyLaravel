<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Role_User : Pivot 테이블, Users - Roles 두 테이블을 연결하는 테이블, 알파벳 순으로 지정
class RoleUser extends Model
{
    use HasFactory;
}
