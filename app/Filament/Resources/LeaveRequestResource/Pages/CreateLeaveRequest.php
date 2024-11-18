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
        $data = ['name' => 'John Doe'];
        Mail::to('yudha.arzi@ia.itera.ac.id')->send(new SendEmail($data));
    }
}
    