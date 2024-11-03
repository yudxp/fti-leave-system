<!DOCTYPE html>
<html>
<head>
    <title>Leave Request</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .content { margin: 20px; }
        .row { margin: 10px 0; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LEAVE REQUEST FORM</h2>
    </div>
    
    <div class="content">
        <div class="row">
            <span class="label">Employee Name:</span> {{ $record->employee->name }}
        </div>
        <div class="row">
            <span class="label">Leave Type:</span> {{ $record->leaveType->name }}
        </div>
        <div class="row">
            <span class="label">Duration:</span> 
            {{ \Carbon\Carbon::parse($record->start_date)->format('M d, Y') }} to 
            {{ \Carbon\Carbon::parse($record->end_date)->format('M d, Y') }}
        </div>
        <div class="row">
            <span class="label">Reason:</span> {{ $record->reason }}
        </div>
        <div class="row">
            <span class="label">Status:</span> {{ ucfirst($record->status) }}
        </div>
        @if($record->admin_remarks)
        <div class="row">
            <span class="label">Admin Remarks:</span> {{ $record->admin_remarks }}
        </div>
        @endif
    </div>
</body>
</html>