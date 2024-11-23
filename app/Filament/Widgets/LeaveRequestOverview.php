<?php

namespace App\Filament\Widgets;

use App\Models\LeaveRequest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Employee;
use App\Models\LeaveBalance;

class LeaveRequestOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $stats = [
            Stat::make('Jumlah Leave Request', LeaveRequest::where('employee_id', auth()->user()->employee->id)->count()),
            Stat::make('Jumlah Leave Request Disetujui', LeaveRequest::where('employee_id', auth()->user()->employee->id)->whereHas('approvalStatus', function($query) {
                $query->where('status', 'approved');
            })->count()),
            Stat::make('Jumlah Leave Request Ditolak', LeaveRequest::where('employee_id', auth()->user()->employee->id)->whereHas('approvalStatus', function($query) {
                $query->where('status', 'rejected'); 
            })->count()),
            Stat::make('Jumlah Leave Request Diproses', LeaveRequest::where('employee_id', auth()->user()->employee->id)->whereHas('approvalStatus', function($query) {
                $query->where('status', 'in_process');
            })->count()),
            Stat::make('Jumlah Cuti Tersisa', LeaveBalance::where('employee_id', auth()->user()->employee->id)->first()->remaining_leave_days),
            Stat::make('Jumlah Cuti Tersisa Tahun Ini', LeaveBalance::where('employee_id', auth()->user()->employee->id)->where('year', now()->year)->first()->remaining_leave_days),
        ];

        if (auth()->user()->hasRole(['Super Admin', 'Kepegawaian'])) {
            $stats[] = Stat::make('Jumlah Employee', Employee::count());
        }

        return $stats;
    }
}
