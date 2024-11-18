<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use EightyNine\Approvals\Models\ApprovableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class LeaveRequest
 *
 * @property $id
 * @property $employee_id
 * @property $leave_type_id
 * @property $start_date
 * @property $end_date
 * @property $reason
 * @property $status
 * @property $admin_remarks
 * @property $created_at
 * @property $updated_at
 *
 * @property Employee $employee
 * @property LeaveType $leaveType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */

 
class LeaveRequest extends ApprovableModel
{
    public bool $autoSubmit = true;
    use HasFactory;
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = ['employee_id', 'leave_type_id', 'start_date', 'end_date', 'reason', 'status', 'admin_remarks'];
    protected $fillable = ['employee_id', 'leave_type_id', 'start_date', 'end_date', 'attachment', 'reason', 'telepon', 'alamat_cuti'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id', 'id');
    }

    public function user()
    {
        return $this->employee->user();
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leaveType()
    {
        return $this->belongsTo(\App\Models\LeaveType::class, 'leave_type_id', 'id');
    }
    
}
