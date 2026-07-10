<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LibrarySectionResource\Pages;
use App\Filament\Resources\LibrarySectionResource\RelationManagers\ArticlesRelationManager;
use App\Models\LibrarySection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LibrarySectionResource extends Resource
{
    protected static ?string $model = LibrarySection::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Heart Health Library';

    protected static ?string $navigationLabel = 'Sections';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Section')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->helperText('e.g. Heart Conditions, Symptoms, Medications'),
                    Forms\Components\TextInput::make('slug')
                        ->helperText('Leave blank to auto-generate from the title.')
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                    Forms\Components\Textarea::make('description')
                        ->label('Card description')
                        ->helperText('Short blurb shown on the homepage card.')
                        ->rows(2)
                        ->maxLength(500)
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('image')
                        ->label('Card image')
                        ->image()
                        ->directory('library/sections')
                        ->imageEditor(),
                    Forms\Components\RichEditor::make('body')
                        ->label('Section intro (optional)')
                        ->columnSpanFull(),
                ])->columns(2),

            Forms\Components\Section::make('Display & SEO')
                ->collapsed()
                ->schema([
                    Forms\Components\Toggle::make('is_published')->default(true),
                    Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                    Forms\Components\TextInput::make('meta_title')->maxLength(255),
                    Forms\Components\Textarea::make('meta_description')->rows(2)->maxLength(255),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')->label('#')->sortable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('articles_count')->counts('articles')->label('Articles'),
                Tables\Columns\IconColumn::make('is_published')->boolean()->label('Published'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published'),
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
            ArticlesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLibrarySections::route('/'),
            'create' => Pages\CreateLibrarySection::route('/create'),
            'edit' => Pages\EditLibrarySection::route('/{record}/edit'),
        ];
    }
}
