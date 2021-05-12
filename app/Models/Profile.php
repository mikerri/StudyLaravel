<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['tel', 'address'];

    public function user() {
        // 일대일 관계
        // Profile 클래스를 User 클래스에 속하도록 설정
        return $this->belongsTo(User::class);
    }
}
