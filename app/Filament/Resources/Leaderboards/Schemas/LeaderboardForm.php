<?php

namespace App\Filament\Resources\Leaderboards\Schemas;

use App\Enums\ResetSchedule;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Tiptap\Nodes\Text;

class LeaderboardForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->string()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->unique()
                    ->string()
                    ->maxLength(255),
                TextInput::make('sort_order')
                    ->default(0)
                    ->integer(),
                Select::make('reset_schedule')
                    ->options(
                        collect(ResetSchedule::cases())
                            ->mapWithKeys(fn ($case) => [$case->value => $case->name])
                    )
                    ->required(),
                TextInput::make('max_entries')
                    ->default(100)
                    ->integer(),
                Section::make('Entries')
                    ->description('Manage the entries associated with this leaderboard in the Entries section after saving.')
                    ->collapsible()
                    ->components([
                        Repeater::make('entries')
                        ->relationship('entries')
                        ->disableLabel()
                        ->columns(2)
                        ->schema([
                            TextInput::make('score')
                                ->label('Score')
                                ->required()
                                ->integer(),
                            TextInput::make('display_name')
                                ->label('Display Name')
                                ->required()
                                ->maxLength(255),
                    ]),
                    ])
                    ->collapsed(),
            ]);
    }
}
