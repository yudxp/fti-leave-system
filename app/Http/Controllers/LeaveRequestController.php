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
        $record->status = 'approved';
        $record->save();

        $recipient = Employee::find($record->employee_id)->user;

        Notification::make()
            ->title('Leave request approved')
            ->sendToDatabase($recipient);

        return redirect()->back()->with('success', 'Leave request approved successfully');
    }

    public function reject(LeaveRequest $record)
    {
        $record->status = 'rejected';
        $record->save();

        $recipient = Employee::find($record->employee_id)->user;

        Notification::make()
            ->title('Leave request rejected')
            ->sendToDatabase($recipient);

        return redirect()->back()->with('success', 'Leave request rejected successfully');
    }


    public function print(LeaveRequest $record)
    {
        $record->load(['employee', 'leaveType']);
        $pdf = Pdf::setOption(['isRemoteEnabled' => true]);
        $pdf = Pdf::loadView('leave-requests.print', compact('record'))
            ->setPaper('a4');
        // return $pdf->download('leave-request.pdf');
        return $pdf->stream('leave-request.pdf');
    }

}
