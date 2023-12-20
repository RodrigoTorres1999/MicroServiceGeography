<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;


class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'city',
        'department_id',
       
    ];



    public function department()
{
    return $this->belongsTo(Department::class);
}
}
