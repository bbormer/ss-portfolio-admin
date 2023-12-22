<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Notification;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Config;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NotificationResource\Pages;
use App\Filament\Resources\NotificationResource\RelationManagers;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell';
    // protected static ?string $navigationLabel = 'お知らせ';

    public static function canCreate(): bool
    {
      return config('custom.notification_create');
    }

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                DateTimePicker::make('startTime')
                    ->label(__('Start Date/Time'))
                    ->required()
                    ->seconds(false)
                    ->native(false)
                    ->placeholder('お知らせ表示開始日・時刻')->default(today()),
                DateTimePicker::make('endTime')
                    ->label(__('End Date/Time'))
                    ->required()
                    ->seconds(false)
                    ->native(false)
                    ->after('startTime')
                    ->placeholder('お知らせ表示終了日・時刻')
                    ->validationMessages([
                        'after' => '終了が開始以前です',
                    ]),
                TextInput::make('url')
                    ->nullable()
                    ->label('URL')
                    ->activeUrl()
                    ->placeholder('お知らせで表示するURL（お知らせなしはスペースで）')
                    ->validationMessages([
                        'activeUrl' => 'URLが無効です',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->columns([
                //
                TextColumn::make('startTime'),
                TextColumn::make('endTime'),
                TextColumn::make('url')->label('URL')
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotification::route('/create'),
            'edit' => Pages\EditNotification::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return (__('Notification'));
    }

    // public static function getPluralModelLabel(): string
    // {
    //     return (__('Notification'));
    // }
}
