<?php

namespace App\Filament\Widgets;

use App\Models\LeaveRequest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Employee;

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
        ];

        if (auth()->user()->hasRole(['Super Admin', 'Kepegawaian'])) {
            $stats[] = Stat::make('Jumlah Employee', Employee::count());
        }

        return $stats;
    }
}
