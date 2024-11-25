<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Saade\FilamentAutograph\Forms\Components\SignaturePad;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction as TablesExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('position')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('department')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nip')
                    ->required()
                    ->unique()
                    ->label('NIP')
                    ->minLength(18)
                    ->maxLength(18),
                Forms\Components\DatePicker::make('start_working')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->maxLength(255)
                    ->email()
                    ->regex('/^[\w\.-]+@([\w-]+\.)*itera\.ac\.id$/') // Allows subdomains and main domain of itera.ac.id
                    ->helperText('Only emails from @itera.ac.id or its subdomains are allowed'),
                // Forms\Components\FileUpload::make('signature')
                //     ->directory('uploads/signatures')
                //     ->acceptedFileTypes(['image/png']),
                // ->required(),
                SignaturePad::make('signature'),
                Select::make('status_pegawai')
                    ->relationship(name: 'statusPegawai', titleAttribute: 'status_pegawai')
                    ->label('Status Pegawai')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('department')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nip')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_working')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')->label('Email')
                    ->sortable(),
                Tables\Columns\TextColumn::make('statusPegawai.status_pegawai')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                TablesExportAction::make()->exports([
                    ExcelExport::make()->fromTable()->withColumns([
                        Column::make('nip')->heading('NIP'),
                        Column::make('user.email')->heading('Email'),
                    ])
                ])->label('Export')->icon('heroicon-o-arrow-up-tray'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
