<?php

namespace App\Filament\Resources\LeaveRequestResource\Pages;

use App\Filament\Resources\LeaveRequestResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use EightyNine\Approvals\Models\ApprovableModel;
class ViewLeaveRequest extends ViewRecord
{
    use  \EightyNine\Approvals\Traits\HasApprovalHeaderActions;

    protected static string $resource = LeaveRequestResource::class;

    /**
     * Get the completion action.
     *
     * @return Filament\Actions\Action
     * @throws Exception
     */
    protected function getOnCompletionAction(): Action
    {
        // Mail::to('yudha.arzi@ia.itera.ac.id')->send(new SendEmail($data)); // send mail to user when finish
        return Action::make("Done")
            ->color("success");
    }
}
