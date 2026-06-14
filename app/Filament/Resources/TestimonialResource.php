<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('patient_name')->required()->maxLength(255),
            Forms\Components\Select::make('rating')
                ->options([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'])
                ->native(false),
            Forms\Components\Textarea::make('content')->required()->rows(4)->columnSpanFull(),
            Forms\Components\FileUpload::make('image')
                ->image()
                ->directory('testimonials')
                ->avatar(),
            Forms\Components\FileUpload::make('consent_file')
                ->label('Signed consent (file)')
                ->helperText('Upload the patient\'s written consent. Required before approving.')
                ->directory('consents')
                ->acceptedFileTypes(['application/pdf', 'image/*']),
            Forms\Components\Toggle::make('is_approved')
                ->helperText('Only approve once written consent is on file.'),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')->label('#')->sortable(),
                Tables\Columns\TextColumn::make('patient_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('content')->limit(50),
                Tables\Columns\TextColumn::make('rating')->badge(),
                Tables\Columns\IconColumn::make('consent_file')->label('Consent')->boolean()
                    ->getStateUsing(fn ($record) => filled($record->consent_file)),
                Tables\Columns\IconColumn::make('is_approved')->boolean()->label('Approved'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_approved'),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
