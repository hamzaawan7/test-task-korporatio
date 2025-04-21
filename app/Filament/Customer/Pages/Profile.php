<?php

namespace App\Filament\Customer\Pages;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Profile extends Page
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static string $view = 'filament.customer.pages.profile';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(auth()->user()->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\Section::make('Profile Information')
                    ->schema([
                        Components\FileUpload::make('profile_photo_path')
                            ->label('Profile Photo')
                            ->directory('profile-photos')
                            ->image()
                            ->avatar(),
                        Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                    ])->columns(2),

                Components\Section::make('Update Password')
                    ->schema([
                        Components\TextInput::make('current_password')
                            ->password()
                            ->revealable()
                            ->requiredWith('new_password')
                            ->currentPassword(),
                        Components\TextInput::make('new_password')
                            ->password()
                            ->revealable()
                            ->rule(Password::default())
                            ->autocomplete('new-password'),
                        Components\TextInput::make('new_password_confirmation')
                            ->password()
                            ->revealable()
                            ->same('new_password'),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save changes')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $user = auth()->user();
        $data = $this->form->getState();

        if (!empty($data['new_password'])) {
            $user->password = Hash::make($data['new_password']);
        }

        $user->update($data);

        Notification::make()
            ->title('Profile updated successfully')
            ->success()
            ->send();
    }
}
