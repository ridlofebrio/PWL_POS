<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\LevelModel; 
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable implements JWTSubject
{
    // Add the missing methods
    use HasFactory;

    public function getJWTIdentifier(){
        return $this->getKey();
    }
    public function getJWTCustomClaims(){
        return[];
    }

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    
    protected $fillable = ['level_id', 'username', 'nama', 'password'];
}
// {
//     use HasFactory;

//     protected $table = 'm_user';
//     public $timestamps = false;
//     protected $primaryKey = 'user_id';

//     protected $fillable = ['user_id','level_id','username','nama','password'];

//     public function level(): BelongsTo
//     {
//         return $this->belongsTo(LevelModel::class,'level_id','level_id');
//     }
// }