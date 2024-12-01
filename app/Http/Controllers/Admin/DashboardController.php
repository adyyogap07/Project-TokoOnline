<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = User::count();
        $revenue = Transaction::sum('total_price');
        $transaction = Transaction::count();
        
        // Tambahkan query untuk mengambil data transaksi terbaru
        $transaction_data = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->latest()
            ->take(5)
            ->get();

        return view('pages.admin.dashboard', [
            'customer' => $customer,
            'revenue' => $revenue,
            'transaction' => $transaction,
            'transaction_data' => $transaction_data // Tambahkan ini
        ]);
    }
}