<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPegawai extends Model
{
    protected $table = 'status_pegawai';

    protected $fillable = ['status_pegawai', 'employee_id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
