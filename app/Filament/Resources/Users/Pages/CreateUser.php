<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $roles = $data['roles'] ?? [];
        unset($data['roles']);

        $data['password'] = bcrypt($data['password']);

        $this->roles = $roles;

        return $data;
    }

    protected function afterCreate(): void
    {
        $this->record->syncRoles($this->roles ?? []);
    }
}