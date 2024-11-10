<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Notifications\Notification;
class LeaveRequestController extends Controller
{
    //
    public function approve(LeaveRequest $record)
    {
        $record->update(['status' => 'approved']);

        $recipient = Employee::find($record->employee_id)->user;
 
        Notification::make()
            ->title('Leave request approved')
            ->sendToDatabase($recipient);

        return redirect()->back()->with('success', 'Leave request approved successfully');
    }

    public function reject(LeaveRequest $record)
    {
        dd($record);
    }

    public function print(LeaveRequest $record)
    {
        $record->load(['employee', 'leaveType']);
        $pdf = Pdf::loadView('leave-requests.print', compact('record'));
        return $pdf->download('leave-request.pdf');
    }
}
