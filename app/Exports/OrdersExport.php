<?php

namespace App\Exports;

use App\Models\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Order::with('user')
            ->get()
            ->map(function ($order) {
            return [
                'invoice' => 'INV-' . date('Y') . '-' . str_pad($order->id, 5, '0', STR_PAD_LEFT),
                'id' => $order->id,
                'customer' => $order->name,
                'email' => $order->user?->email ?? '-',
                'phone' => "'" . $order->phone,
                'address' => $order->address,

                'total_items' => $order->items->count(),
                'total_qty' => $order->items->sum('quantity'),

                'total' => $order->total,
                'status' => strtoupper($order->status),
                'payment_status' => strtoupper($order->payment_status ?? 'PENDING'),
                'tracking_number' => $order->tracking_number ?? '-',
                'tanggal' => $order->created_at->format('d-m-Y H:i'),
            ];
            });
    }

    public function headings(): array
    {
        return [
            'Invoice',
            'Order ID',
            'Customer',
            'Email',
            'Phone',
            'Alamat',
            'Jumlah Produk',
            'Total Qty',
            'Total',
            'Status Pesanan',
            'Status Pembayaran',
            'Nomor Resi',
            'Tanggal',
        ];
    }
}
