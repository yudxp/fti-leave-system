<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LeaveType
 *
 * @property $id
 * @property $type
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class LeaveType extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];


}

class AddLeaveReasonToLeaveTypesTable extends Model
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leave_types', function (Blueprint $table) {
            $table->string('leave_reason')->nullable(); // Add the leave_reason column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_types', function (Blueprint $table) {
            $table->dropColumn('leave_reason'); // Remove the leave_reason column
        });
    }
}
