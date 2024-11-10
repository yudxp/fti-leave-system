<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class LeaveRequestController extends Controller
{
    //
    public function approve(LeaveRequest $record)
    {
        $record->update(['status' => 'approved']);
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
