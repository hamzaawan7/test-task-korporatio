<?php

namespace App\Filament\Customer\Resources;

use App\Filament\Customer\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->label('Product')
                    ->reactive()
                    ->required()
                    ->searchable()
                    ->preload()
                    ->afterStateUpdated(function ($state, $get, $set) {
                        $product = Product::find($state);
                        $unitPrice = $product?->price ?? 0;
                        $qty = $get('quantity') ?? 1;
                        $set('total_price', $unitPrice * $qty);
                    }),

                Forms\Components\TextInput::make('quantity')
                    ->label('Quantity')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->reactive()
                    ->afterStateUpdated(function ($state, $get, $set) {
                        $unitPrice = Product::find($get('product_id'))?->price ?? 0;
                        $set('total_price', $unitPrice * $state);
                    }),

                Forms\Components\TextInput::make('total_price')
                    ->label('Total Price')
                    ->numeric()
                    ->disabled()
                    ->required()
                    ->prefix('$'),

                Forms\Components\TextInput::make('customer_name')
                    ->default(auth()->user()->name)
                    ->required(),
                Forms\Components\TextInput::make('customer_email')
                    ->default(auth()->user()->email)
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('customer_phone'),
                Forms\Components\Textarea::make('customer_address'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('total_price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->where('user_id', auth()->id()));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
