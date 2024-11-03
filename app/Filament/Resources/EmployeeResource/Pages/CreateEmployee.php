<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Mail\UserRegistered;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        try {
            validator($data, [
                'email' => ['required', 'email', 'unique:users,email'],
            ], [
                'email.unique' => 'This email is already registered in the system.',
            ])->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            Notification::make()
                ->title('Error')
                ->body('This email is already registered in the system.')
                ->danger()
                ->send();
            throw $e;
        }

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make('123456'); //default password
        $user->save();
        $data['user_id'] = $user->id;

        Mail::to($user->email)->send(new UserRegistered($user));

        return $data;
    }
}
