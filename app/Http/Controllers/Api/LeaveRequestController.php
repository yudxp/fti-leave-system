<?php

namespace App\Http\Controllers\Api;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequestRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\LeaveRequestResource;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $leaveRequests = LeaveRequest::paginate();

        return LeaveRequestResource::collection($leaveRequests);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveRequestRequest $request): LeaveRequest
    {
        return LeaveRequest::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveRequest $leaveRequest): LeaveRequest
    {
        return $leaveRequest;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveRequestRequest $request, LeaveRequest $leaveRequest): LeaveRequest
    {
        $leaveRequest->update($request->validated());

        return $leaveRequest;
    }

    public function destroy(LeaveRequest $leaveRequest): Response
    {
        $leaveRequest->delete();

        return response()->noContent();
    }
}
