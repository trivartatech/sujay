<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProcedureResource\Pages;
use App\Models\Procedure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProcedureResource extends Resource
{
    use Translatable;

    protected static ?string $model = Procedure::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Services';

    protected static ?string $modelLabel = 'Service';

    protected static ?int $navigationSort = 3;

    /** Icon names supported by resources/views/components/icon.blade.php */
    public const ICONS = [
        'heart-pulse' => 'Heart pulse',
        'heart-artery' => 'Heart / artery',
        'heart-failure' => 'Heart failure',
        'activity' => 'ECG / arrhythmia',
        'valve' => 'Valve',
        'syringe' => 'Interventional / syringe',
        'lungs' => 'Lungs',
        'stethoscope' => 'Stethoscope',
        'shield-check' => 'Prevention / shield',
    ];

    /** @return list<string> */
    public static function getTranslatableLocales(): array
    {
        return \App\Support\Locale::adminLocales();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('title')->required()->maxLength(255),
                    Forms\Components\TextInput::make('slug')
                        ->helperText('Leave blank to auto-generate.')
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                    Forms\Components\Textarea::make('summary')
                        ->rows(2)
                        ->maxLength(500)
                        ->columnSpanFull(),
                    Forms\Components\RichEditor::make('body')->columnSpanFull(),
                    Forms\Components\FileUpload::make('image')
                        ->image()
                        ->directory('procedures')
                        ->imageEditor(),
                    Forms\Components\Select::make('icon')
                        ->options(self::ICONS)
                        ->native(false)
                        ->default('heart-pulse')
                        ->helperText('Icon shown in the "Comprehensive Cardiac Care" strip.'),
                ])->columns(2),

            Forms\Components\Section::make('Display & SEO')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProcedures::route('/'),
            'create' => Pages\CreateProcedure::route('/create'),
            'edit' => Pages\EditProcedure::route('/{record}/edit'),
        ];
    }
}
