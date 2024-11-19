<?php

namespace App\Filament\Resources\ResearchGroupResource\Pages;

use App\Filament\Resources\ResearchGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResearchGroup extends EditRecord
{
    protected static string $resource = ResearchGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
