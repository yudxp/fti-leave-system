<?php

namespace App\Livewire;

use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasSort;
use Filament\Forms\Components\FileUpload;

class CustomProfileComponent extends Component implements HasForms
{
    use InteractsWithForms;
    use HasSort;

    public ?array $data = [];

    protected static int $sort = 0;

    public function mount(): void
    {
        $user = auth()->user();
        $customFields = $user->custom_fields ?? [];
        
        // Check if custom_fields is a JSON string and decode it
        if (is_string($customFields)) {
            $customFields = json_decode($customFields, true);
        }
        
        $this->form->fill([
            'signature' => $customFields['signature'] ?? null,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Upload Signature')
                    ->aside()
                    ->description('Upload tanda tangan Anda dalam format gambar')
                    ->schema([
                        FileUpload::make('signature')
                            ->image()
                            ->imageEditor()
                            ->directory('signatures')
                            ->maxSize(2048) // 2MB
                            ->label('Tanda Tangan')
                            ->helperText('Upload file tanda tangan (PNG, JPG, max 2MB)')
                            ->imagePreviewHeight('150')
                            ->downloadable()
                            ->openable(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        
        try {
            if (!empty($data['signature'])) {
                $user = auth()->user();
                
                // Initialize custom_fields if it doesn't exist
                $customFields = $user->custom_fields ?? [];
                
                // Update the signature
                $customFields['signature'] = $data['signature'];
                $user->custom_fields = $customFields;
                
                if (!$user->save()) {
                    throw new \Exception('Failed to save signature');
                }
            }
        } catch (\Exception $e) {
            // You can customize this error handling based on your needs
            $this->addError('signature', 'Failed to save signature: ' . $e->getMessage());
        }
    }

    public function render(): View
    {
        return view('livewire.custom-profile-component');
    }
}
