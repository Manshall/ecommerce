<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Filament\Admin\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor; // Pastikan MarkdownEditor di-import
use Filament\Forms\Components\Toggle; // Pastikan Toggle di-import
use Filament\Forms\Components\Fieldset; // Gunakan Fieldset, bukan Group
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

use Illuminate\Support\Str; // Pastikan Str di-import
use Filament\Tables\Columns\BooleanColumn; // Untuk menampilkan status boolean sebagai ikon

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Product Information')->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->reactive()
                        ->afterStateUpdated(function (?string $state, callable $set) {
                            // Update slug saat name berubah
                            if ($state) {
                                $set('slug', Str::slug($state));
                            }
                        }),

                    TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->disabled()
                        ->dehydrated()
                        ->unique(Product::class, 'slug', ignoreRecord:true),

                    MarkdownEditor::make('description')
                        ->columnSpanFull()
                        ->fileAttachmentsDirectory('products'),
                ])->columns(2),

                Section::make('Images')->schema([
                    FileUpload::make('images')
                        ->multiple()
                        ->directory('products')
                        ->maxFiles(5)
                        ->reorderable()
                ])->columnSpan(2),

                Section::make('Price')->schema([
                    TextInput::make('price')
                        ->numeric()
                        ->required()
                        ->prefix('INR')
                ]),

                Section::make('Associations')->schema([
                    Select::make('category_id')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship('category', 'name'),

                    Select::make('brand_id')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship('brand', 'name'),
                ]),

                Section::make('Status')->schema([
                    Toggle::make('in_stock')
                        ->required()
                        ->default(true),

                    Toggle::make('is_active')
                        ->required()
                        ->default(true),

                    Toggle::make('is_featured')
                        ->required(),

                    Toggle::make('on_sale')
                        ->required(),
                ])
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([ 
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->sortable(),
                TextColumn::make('brand.name')
                    ->sortable(),
                TextColumn::make('price')
                    ->money('INR')
                    ->sortable(),
                
                    IconColumn::make('is_featured')
                    ->boolean(),
                
                IconColumn::make('on_sale')
                    ->boolean(),
                
                IconColumn::make('in_stock')
                    ->boolean(),
                IconColumn::make('is_active')
                    ->boolean(),

                IconColumn::make('create_at')
                    ->boolean()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('updated_at')
                    ->boolean()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                
            ])
            ->filters([ 
              SelectFilter::make('category')
                ->relationship('category','name'),

              SelectFilter::make('brand')
                ->relationship('brand','name'),
            ])
            ->actions([ 
               ActionGroup::make([
                ViewAction::make(),
                EditAction::make(),
                DeleteACtion::make(),
               ])
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
            // Tambahkan relasi jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
