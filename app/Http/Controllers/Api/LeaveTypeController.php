<?php

namespace App\Http\Controllers\Api;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use App\Http\Requests\LeaveTypeRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\LeaveTypeResource;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $leaveTypes = LeaveType::paginate();

        return LeaveTypeResource::collection($leaveTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveTypeRequest $request): LeaveType
    {
        return LeaveType::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveType $leaveType): LeaveType
    {
        return $leaveType;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveTypeRequest $request, LeaveType $leaveType): LeaveType
    {
        $leaveType->update($request->validated());

        return $leaveType;
    }

    public function destroy(LeaveType $leaveType): Response
    {
        $leaveType->delete();

        return response()->noContent();
    }
}
