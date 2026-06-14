<?php

namespace App\Filament\Resources\Roles\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Spatie\Permission\Models\Permission;

class RolesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Role Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('permissions.name')
                    ->label('Permissions')
                    ->badge()
                    ->limit(3),
            ])
            ->filters([
                SelectFilter::make('permissions')
                    ->label('Permission')
                    ->options(
                        Permission::query()->pluck('name', 'name')->toArray()
                    )
                    ->query(function ($query, $data) {
                        if (! $data['value']) return $query;

                        return $query->whereHas('permissions', function ($q) use ($data) {
                            $q->where('name', $data['value']);
                        });
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}