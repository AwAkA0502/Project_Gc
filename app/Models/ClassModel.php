<?php

// app/Models/ClassModel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $fillable = ['class_name', 'subject_name', 'class_code'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
