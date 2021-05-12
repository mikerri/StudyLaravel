<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// 모든 라라벨의 Model은 Eloquent ORM(Illuminate\Database\Eloquent\Model)을 자동으로 상속함 => Table의 각 Record를 객체화함.
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;
}
