<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        if(Auth::user()->hasRole('admin')){
            $transactions = Transaction::search('invoice')
                ->with('details')
                ->latest()
                ->paginate(10)
                ->withQueryString();
        }else{
            $transactions = Transaction::search('invoice')
                ->with('details')
                ->where('user_id', Auth::id())
                ->latest()
                ->paginate(10)
                ->withQueryString();
        }

        return view('backoffice.transaction.index', compact('transactions'));
    }
}
