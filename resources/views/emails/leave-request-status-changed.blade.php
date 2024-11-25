<div>
    <h1>Leave Request Status Update</h1>
    <p>Your leave request status has been updated to: {{ $leaveRequest->status }}</p>
    <p>Details:</p>
    <ul>
        <li>Start Date: {{ $leaveRequest->start_date }}</li>
        <li>End Date: {{ $leaveRequest->end_date }}</li>
        <li>Type: {{ $leaveRequest->leaveType->name }}</li>
    </ul>
</div> 