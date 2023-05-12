<?php

namespace App\Domain\Patients\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = [
        'name','diagnosis',
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
