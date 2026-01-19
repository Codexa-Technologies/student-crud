<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'course_code',
        'start_date',
        'duration',
        'leader',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
