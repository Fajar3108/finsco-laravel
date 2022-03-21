<?php

namespace App\Http\Controllers;

use App\Models\TransactionType;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index($type)
    {
        $transactions = TransactionType::where('slug', $type)->first()->transactions()->latest()->paginate(20);

        return view('transactions.index', compact('transactions'));
    }
}
