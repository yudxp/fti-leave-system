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
            Stat::make('Jumlah Leave Request', LeaveRequest::count()),
            Stat::make('Jumlah Leave Request Disetujui', LeaveRequest::where('status', 'disetujui')->count()),
            Stat::make('Jumlah Leave Request Ditolak', LeaveRequest::where('status', 'ditolak')->count()),
            Stat::make('Jumlah Leave Request Pending', LeaveRequest::where('status', 'pending')->count()),
        ];

        if (auth()->user()->hasRole(['Super Admin', 'Kepegawaian'])) {
            $stats[] = Stat::make('Jumlah Employee', Employee::count());
        }

        return $stats;
    }
}
