<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Blog;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BlogResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BlogResource\RelationManagers;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
                ->schema([
                    Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Title')
                    ->columnSpan('full'),

                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label('Description')
                    ->columnSpan('full'),

                Forms\Components\FileUpload::make('photo')
                    ->label('Photo')
                    ->image()
                    ->directory('blog_photos')
                    ->required()
                    ->columnSpan('full'),

                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('user.name')->label('Author')->sortable(),
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Photo')
                    ->size(50),
                Tables\Columns\BadgeColumn::make('status')
                ->formatStateUsing(function ($state) {
                    return $state == 1 ? 'Pending' : ($state == 2 ? 'Approved' : 'Rejected');
                })
                ->colors([
                    'warning' => 1,
                    'success' => 2,
                    'danger' => 3,
                ]),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

                // Tambahkan Custom Action untuk Approve dan Reject
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->action(function ($record) {
                        $record->update(['status' => 2]);
                    })
                    ->visible(fn() => Auth::user()->id === 1) // Hanya tampil untuk admin
                    ->color('success')
                    ->icon('heroicon-o-check'),

                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->action(function ($record) {
                        $record->update(['status' => 3]);
                    })
                    ->visible(fn() => Auth::user()->id === 1) // Hanya tampil untuk admin
                    ->color('danger')
            ->icon('heroicon-o-x-circle'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
