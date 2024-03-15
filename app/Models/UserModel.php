<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\LevelModel;

class UserModel extends Model
{
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    protected $fillable = ['level_id','username','nama','password'];
    
    public function level(): BelongsTo{
        return $this->belongsTo(LevelModel::class);
}
}