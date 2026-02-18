<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\User;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'address',
        'city_id',
        'manager_id',
        'is_active',
        'main_branch_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function main_branch()
    {
        return $this->belongsTo(Branch::class, 'main_branch_id');
    }
}
