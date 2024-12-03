<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EventResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EventResource\RelationManagers;
use Filament\Resources\RelationManagers\RelationManager;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('photo')
                    ->label('Photo')
                    ->image()
                    ->directory('event_photos')
                    ->required()
                    ->columnSpan('full'),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Name')
                    ->columnSpan('full'),

                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label('Description')
                    ->columnSpan('full'),

                // capacity type is select
                Forms\Components\Select::make('capacity_type')
                    ->required()
                    ->label('Capacity')
                    ->options([
                        1 => 'Limited',
                        2 => 'Unlimited',
                    ])
                    ->reactive(), // Pastikan perubahan nilai ini terdeteksi secara reaktif

                Forms\Components\TextInput::make('capacity_max')
                    ->label('Capacity Max')
                    ->reactive() // Pastikan input ini merespon perubahan
                    ->disabled(fn ($get) => $get('capacity') === '2'), // Disabled jika kapasitas 'Unlimited'

                Forms\Components\DatePicker::make('start_date')
                    ->required()
                    ->label('Start Date'),

                Forms\Components\DatePicker::make('end_date')
                    ->required()
                    ->label('End Date'),

                // location type is textarea
                Forms\Components\Textarea::make('location')
                    ->required()
                    ->label('Location')
                    ->columnSpan('full'),

                // type event is select
                Forms\Components\Select::make('event_type')
                    ->required()
                    ->label('Event Type')
                    ->options([
                        '1' => 'Free',
                        '2' => 'Paid',
                    ]),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Name')->sortable()->searchable(),

                // Start Date
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date')->date(),

                // End Date
                Tables\Columns\TextColumn::make('end_date')
                    ->label('End Date')->date(),

                // location
                Tables\Columns\TextColumn::make('location')
                    ->label('Location')
                    ->searchable(),

                // status
                Tables\Columns\BadgeColumn::make('status')
                    ->formatStateUsing(function ($state) {
                        return $state == 1 ? 'Pending' : ($state == 2 ? 'Approved' : 'Rejected');
                    })
                    ->colors([
                        'warning' => 1,
                        'success' => 2,
                        'danger' => 3,
                    ]),

                // event type
                Tables\Columns\BadgeColumn::make('event_type')
                    ->formatStateUsing(function ($state) {
                        return $state == 1 ? 'Free' : 'Paid';
                    })
                    ->colors([
                        'success' => 1,
                        'danger' => 2,
                    ]),

                // capacity type
                Tables\Columns\BadgeColumn::make('capacity_type')
                    ->label('Capacity Type')
                    ->formatStateUsing(function ($state) {
                        return $state == 1 ? 'Limited' : 'Unlimited';
                    })
                    ->colors([
                        'warning' => 1,
                        'success' => 2,
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        if (Auth::user()->id !== 1) {
            $query->where('user_id', Auth::id());
        }

        return $query;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
