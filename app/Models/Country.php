<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'country',
        'code',
        'dial_code',
    ];




    public function departments()
{
    return $this->hasMany(Department::class);
}
}
