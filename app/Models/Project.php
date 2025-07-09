<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('is_owner')
            ->withTimestamps();
    }

    public function columns()
    {
        return $this->hasMany(Column::class)->orderBy('order');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    
    public function tasks()
    {
    return $this->hasMany(Task::class);
    }
}
