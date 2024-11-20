<?php

namespace App\Filament\Resources\LeaveRequestResource\Pages;

use App\Filament\Resources\LeaveRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
class CreateLeaveRequest extends CreateRecord
{
    protected static string $resource = LeaveRequestResource::class;

    protected function afterCreate(): void
    {
        // Send email notification
        $data = [
            'nama' => auth()->user()->name,
            'prodi' => auth()->user()->employee->department,
            'hari' => now()->parse($this->record->start_date)->diffInDays($this->record->end_date) + 1,
            'tipe_cuti' => $this->record->leaveType->name,
            'alasan' => $this->record->reason
        ];

        $approvers = \App\Models\User::role([3,4,5,6])->get();
        foreach ($approvers as $approver) {
            if ($approver->email) {
                Mail::to($approver->email)->send(new SendEmail($data));
            }
        }
        // Mail::to('yudha.arzi@ia.itera.ac.id')->send(new SendEmail($data));
    }
}
    