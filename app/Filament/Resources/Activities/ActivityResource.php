<?php

namespace App\Filament\Resources\Activities;

use App\Filament\Resources\Activities\Pages\CreateActivity;
use App\Filament\Resources\Activities\Pages\EditActivity;
use App\Filament\Resources\Activities\Pages\ListActivities;
use App\Models\Activity;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('category_id')
                ->relationship('category', 'name')
                ->preload()
                ->searchable()
                ->required(),

            TextInput::make('title')
                ->required(),

            Textarea::make('description')
                ->columnSpanFull(),

            DatePicker::make('activity_date')
                ->required(),

            FileUpload::make('image')
                ->image()
                ->directory('activities'),

            Select::make('priority')
                ->options([
                    'low' => 'Low',
                    'medium' => 'Medium',
                    'high' => 'High',
                ])
                ->required(),

            Select::make('status')
                ->options([
                    'draft' => 'Draft',
                    'process' => 'Process',
                    'done' => 'Done',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image'),

            TextColumn::make('title')
                ->searchable()
                ->sortable(),

            TextColumn::make('category.name')
                ->searchable()
                ->sortable(),

            TextColumn::make('activity_date')
                ->date()
                ->sortable(),

            TextColumn::make('priority')
                ->badge(),

            TextColumn::make('status')
                ->badge(),

            TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
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
            'index' => ListActivities::route('/'),
            'create' => CreateActivity::route('/create'),
            'edit' => EditActivity::route('/{record}/edit'),
        ];
    }
}
