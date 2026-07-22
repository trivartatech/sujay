<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LibraryArticleResource\Pages;
use App\Models\LibraryArticle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LibraryArticleResource extends Resource
{
    use Translatable;

    protected static ?string $model = LibraryArticle::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    protected static ?string $navigationGroup = 'Heart Health Library';

    protected static ?string $navigationLabel = 'All Articles';

    protected static ?int $navigationSort = 2;

    /** @return list<string> */
    public static function getTranslatableLocales(): array
    {
        return array_keys(config('site.locales', ['en' => 'English']));
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Article')
                ->schema([
                    Forms\Components\Select::make('library_section_id')
                        ->label('Section')
                        ->relationship('section', 'title')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\TextInput::make('title')->required()->maxLength(255),
                    Forms\Components\TextInput::make('slug')
                        ->helperText('Leave blank to auto-generate.')
                        ->maxLength(255),
                    Forms\Components\FileUpload::make('image')
                        ->image()
                        ->directory('library/articles')
                        ->imageEditor(),
                    Forms\Components\Textarea::make('excerpt')->rows(2)->maxLength(500)->columnSpanFull(),
                    Forms\Components\RichEditor::make('body')->required()->columnSpanFull(),
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
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable()->limit(45),
                Tables\Columns\TextColumn::make('section.title')->badge()->sortable()->label('Section'),
                Tables\Columns\IconColumn::make('is_published')->boolean()->label('Published'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime('d M Y')->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('section')->relationship('section', 'title'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLibraryArticles::route('/'),
            'create' => Pages\CreateLibraryArticle::route('/create'),
            'edit' => Pages\EditLibraryArticle::route('/{record}/edit'),
        ];
    }
}
