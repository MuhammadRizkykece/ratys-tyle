<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([

                TextColumn::make('id')
                    ->label('Order')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Customer')
                    ->searchable(),


                TextColumn::make('phone')
                    ->label('Phone'),


                TextColumn::make('total')
                    ->money('IDR')
                    ->sortable(),


                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'shipped' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('tracking_number')
                    ->label('No. Resi')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime(),

                ImageColumn::make('payment_proof')
                    ->label('Bukti Transfer')
                    ->disk('public')
                    ->height(100),

            ])

            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),

                Filter::make('created_at')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn(Builder $query, $date): Builder =>
                                $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn(Builder $query, $date): Builder =>
                                $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])

            ->actions([

                Action::make('invoice')
                    ->label('Invoice')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('gray')
                    ->url(fn($record) => url('/invoice/' . $record->id))
                    ->openUrlInNewTab(),

                Action::make('export')
                    ->label('Export Laporan')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn() => url('/export-orders'))
                    ->openUrlInNewTab(),

                Action::make('shipOrder')
                    ->label('Kirim Pesanan')
                    ->icon('heroicon-o-truck')
                    ->color('info')

                    ->form([
                        TextInput::make('tracking_number')
                            ->label('Nomor Resi')
                            ->required(),
                    ])

                    ->action(function ($record, array $data) {

                        $record->update([
                            'status' => 'shipped',
                            'tracking_number' => $data['tracking_number'],
                        ]);
                    })

                    ->visible(
                        fn($record) =>
                        $record->status === 'processing'
                    ),

                Action::make('approvePayment')
                    ->label('Terima Pembayaran')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->status === 'pending')
                    ->action(function ($record) {

                        $record->update([
                            'status' => 'processing',
                        ]);
                    }),

                Action::make('completeOrder')
                    ->label('Selesaikan')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->status === 'shipped')
                    ->action(function ($record) {

                        $record->update([
                            'status' => 'completed',
                        ]);
                    }),

                Action::make('cancelOrder')
                    ->label('Batalkan')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn($record) => ! in_array($record->status, [
                        'completed',
                        'cancelled',
                    ]))
                    ->action(function ($record) {

                        $record->update([
                            'status' => 'cancelled',
                        ]);
                    }),

                ViewAction::make(),

                EditAction::make(),

                DeleteAction::make()
                    ->visible(false),

            ]);
    }
}
