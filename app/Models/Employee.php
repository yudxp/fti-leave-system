<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 *
 * @property $id
 * @property $name
 * @property $position
 * @property $department
 * @property $nip
 * @property $start_working
 * @property $email
 * @property $signature
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Employee extends Model
{
    
    protected $perPage = 20;
    // protected $table = "employees";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'position', 'department', 'nip', 'start_working', 'signature', 'user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statusPegawai()
    {
        return $this->hasOne(StatusPegawai::class);
    }
}
