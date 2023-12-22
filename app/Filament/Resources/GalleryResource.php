<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Gallery;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\GalleryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GalleryResource\RelationManagers;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getNavigationBadge(): ?string {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('seq-no')
                    ->label('表示順番')
                    ->numeric()
                    ->required()
                    // ->rules([
                    //     function () {
                    //         return function (string $attribute, $value, Closure $fail) {
                    //             if ($value < 0) {
                    //                 $fail(':attribute で負の値は無効です');
                    //             }
                    //         };
                    //     },
                    // ])
                    // ->step(10),
                    ->minValue(0),
                Section::make('タイトル')
                    // ->description('改行は<br>を挿入')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title-ja')
                            ->label('日本語')
                            ->placeholder('改行は<br>を挿入')
                            ->required()
                            ->validationMessages([
                                'required' => '必須です',
                        ]),
                        TextInput::make('title-en')
                            ->label('英語')
                            ->placeholder('改行は<br>を挿入')
                            ->required(),
                    ]),
                FileUpload::make('image')
                    ->required()
                    ->label('画像ファイル')
                    ->disk('public')
                    ->directory('images')
                    ->validationMessages([
                        'activeUrl' => 'URLが無効です',
                    ]),
                Section::make('説明')
                    ->description('改行はshift-returnで')
                    ->schema([
                        TinyEditor::make('desc-ja')
                            ->label('日本語')
                            ->columnSpan('full'),
                        TinyEditor::make('desc-en')
                            ->label('英語')
                            ->columnSpan('full'),
                    ]),
                Section::make()->schema([
                    TextInput::make('amount')
                        ->label('金額')
                        ->required()
                        ->default(0)
                        ->numeric(),
                    TextInput::make('shipping')
                        ->label('送料')
                        ->required()
                        ->numeric()
                        ->default(0),
                    Radio::make('availability')
                        ->label('販売ステータス')
                        ->options([
                            -1 => 'not for sale',
                            0 => 'sold',
                            1 => 'for sale'
                        ])
                        ->default(0),
                ])->columns(2),
                Section::make('仕様')
                    // ->description('改行は<br>を挿入')
                    ->columns(2)
                    ->schema([
                        TextInput::make('details-ja')
                            ->label('日本語')
                            ->placeholder('改行は<br>を挿入')
                            ->required(),
                        TextInput::make('details-en')
                            ->label('英語')
                            ->placeholder('改行は<br>を挿入')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('seq-no')
                    ->label('表示順')
                    ->sortable(),
                TextColumn::make('title-ja')
                    ->html()
                    ->label('作品名')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title-en')
                    ->html()
                    ->label('作品名（英語）')
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('image')
                    // ->circular()
                    ->visibility('private')
                    ->label('画像')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return (__('Gallery'));
    }
}
