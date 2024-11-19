<?php

namespace App\Http\Controllers\Api;

use App\Models\ResearchGroup;
use Illuminate\Http\Request;
use App\Http\Requests\ResearchGroupRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ResearchGroupResource;

class ResearchGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $researchGroups = ResearchGroup::paginate();

        return ResearchGroupResource::collection($researchGroups);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResearchGroupRequest $request): ResearchGroup
    {
        return ResearchGroup::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(ResearchGroup $researchGroup): ResearchGroup
    {
        return $researchGroup;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResearchGroupRequest $request, ResearchGroup $researchGroup): ResearchGroup
    {
        $researchGroup->update($request->validated());

        return $researchGroup;
    }

    public function destroy(ResearchGroup $researchGroup): Response
    {
        $researchGroup->delete();

        return response()->noContent();
    }
}
