<?php
namespace App\Filament\Resources\Roles\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\CheckboxList;
use Spatie\Permission\Models\Permission;

class RoleFormNew
{
    public static function configure(Schema $schema): Schema
    {
         return $schema->schema([
            TextInput::make('name')
                ->required(),

            CheckboxList::make('permissions')
                ->options(
                    Permission::pluck('name', 'name')->toArray()
                ),
        ]);
    }
}