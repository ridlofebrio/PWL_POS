<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\LevelModel;

class UserModel extends Model
{
        protected $table ="user";
        public $timestamps = false;
        protected $primaryKey = 'user_id';
        protected $fillable =[
            'user_id',
            'level_id',
            'username',
            'nama',
            'password',
        ];
}
