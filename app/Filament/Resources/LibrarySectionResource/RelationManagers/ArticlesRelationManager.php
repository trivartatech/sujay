<?php

namespace App\Filament\Resources\LibrarySectionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ArticlesRelationManager extends RelationManager
{
    protected static string $relationship = 'articles';

    protected static ?string $title = 'Articles in this section';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            Forms\Components\TextInput::make('slug')
                ->helperText('Leave blank to auto-generate.')
                ->maxLength(255),
            Forms\Components\FileUpload::make('image')
                ->image()
                ->directory('library/articles')
                ->imageEditor(),
            Forms\Components\Textarea::make('excerpt')
                ->rows(2)
                ->maxLength(500)
                ->columnSpanFull(),
            Forms\Components\RichEditor::make('body')
                ->required()
                ->columnSpanFull(),
            Forms\Components\Toggle::make('is_published')->default(true),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            Forms\Components\TextInput::make('meta_title')->maxLength(255),
            Forms\Components\Textarea::make('meta_description')->rows(2)->maxLength(255),
        ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')->label('#')->sortable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')->searchable()->limit(50),
                Tables\Columns\IconColumn::make('is_published')->boolean()->label('Published'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
