<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            \EightyNine\ExcelImport\ExcelImportAction::make()->validateUsing(
                        ['name' => 'required'],
                        ['position.required' => 'The position name is required.']
                    )->slideOver()->use(\App\Imports\EmployeeImport::class)
                        ->color("primary")
                        ->afterImport(function ($data, $livewire, $excelImportAction) {
                            $livewire->notify('success', 'Data imported successfully');
                        }),
        ];
    }
}
