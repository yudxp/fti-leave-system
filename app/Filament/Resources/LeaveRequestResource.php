<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveRequestResource\Pages;
use App\Filament\Resources\LeaveRequestResource\RelationManagers;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\FileUpload;

class LeaveRequestResource extends Resource
{
    protected static ?string $model = LeaveRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Select::make('employee_id')
                //     ->relationship('employee', 'name')
                //     ->required()
                //     ->preload()
                //     ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->nip} - {$record->name}")
                //     ->live()
                //     ->afterStateUpdated(function (?string $state, ?string $old, $set) {
                //         $employee = Employee::find($state);
                //         if ($employee) {
                //             $set('department', $employee->department);
                //             $set('nip', $employee->nip);
                //             $set('name', $employee->name);  
                //             $set('position', $employee->position);
                //             $set('working_period', $employee->start_working);
                //         } else {
                //             $set('department', null);
                //         }
                //     })
                //     ->searchable(['nip', 'name']),
                Forms\Components\Hidden::make('employee_id')
                    ->default((fn() => auth()->user()->employee->id)),
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->default((fn() => auth()->user()->name))
                    ->disabled(),
                Forms\Components\TextInput::make('nip')
                    ->label('NIP/NRK')
                    ->default((fn() => auth()->user()->employee->nip))
                    ->disabled(),
                Forms\Components\TextInput::make('position')
                    ->label('Jabatan')
                    ->default((fn() => auth()->user()->employee->position))
                    ->disabled(),
                Forms\Components\TextInput::make('working_period')
                    ->label('Masa Kerja')
                    ->default((fn() => auth()->user()->employee->start_working))
                    ->disabled(),
                Forms\Components\TextInput::make('department')
                    ->label('Unit Kerja')
                    ->default((fn() => auth()->user()->employee->department))
                    ->disabled(),
                Forms\Components\Select::make('leave_type_id')
                    ->relationship('leaveType', 'name')
                    ->required()->preload()
                    ->searchable(),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->required(),
                Forms\Components\Textarea::make('reason')
                    ->required(),
                Forms\Components\TextInput::make('alamat_cuti')
                    ->required(),
                Forms\Components\TextInput::make('telepon')
                    ->required(),
                Forms\Components\FileUpload::make('attachment')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $query = LeaveRequest::query();
                if (auth()->user()->hasRole('Employee')) {
                    $query->where('employee_id', auth()->user()->employee->id);
                }
                return $query;
            })
            ->columns([
                Tables\Columns\TextColumn::make('employee.user.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('leaveType.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                // Tables\Columns\TextColumn::make("status"),
                \EightyNine\Approvals\Tables\Columns\ApprovalStatusColumn::make("approvalStatus.status"),
                // Tables\Columns\TextColumn::make('status')
                //     ->badge()
                //     ->color(fn (string $state): string => match ($state) {
                //         'pending' => 'gray',
                //         'reviewing' => 'warning',
                //         'approved' => 'success',
                //         'rejected' => 'danger',
                //     }),
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
                ...\EightyNine\Approvals\Tables\Actions\ApprovalActions::make(
                Action::make("Done"),
                [
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make()
                ]
                ),
                // Action::make('approve')
                //     ->url(fn(LeaveRequest $record) => route('leave-requests.approve', $record))
                //     ->label('Approve')
                //     ->icon('heroicon-o-check-circle')
                //     ->hidden(fn($record) => !auth()->user()->hasRole('Dekan', 'Kepegawaian', 'Wakil Dekan', 'Ketua KK')),
                // Action::make('reject')
                //     ->url(fn(LeaveRequest $record) => route('leave-requests.reject', $record))
                //     ->label('Reject')
                //     ->icon('heroicon-o-x-circle')
                //     ->hidden(fn($record) => $record->status == 'rejected' || !auth()->user()->hasRole('Dekan', 'Kepegawaian', 'Wakil Dekan', 'Ketua KK')),
                Action::make('print')
                    ->url(fn(LeaveRequest $record) => route('leave-requests.print', $record))
                    ->label('Print')
                    ->icon('heroicon-o-printer')
                    // ->hidden(fn($record) => $record->status == 'rejected')
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
            'index' => Pages\ListLeaveRequests::route('/'),
            'create' => Pages\CreateLeaveRequest::route('/create'),
            'edit' => Pages\EditLeaveRequest::route('/{record}/edit'),
            'view' => Pages\ViewLeaveRequest::route('/{record}'),
        ];
    }
}
