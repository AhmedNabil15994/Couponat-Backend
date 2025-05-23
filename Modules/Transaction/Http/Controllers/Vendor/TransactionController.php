<?php

namespace Modules\Transaction\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Transaction\Transformers\Vendor\TransactionResource;
use Modules\Transaction\Repositories\Vendor\TransactionRepository as Transaction;

class TransactionController extends Controller
{
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function index()
    {
        return view('transaction::vendor.transactions.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->transaction->QueryTable($request));

        $datatable['data'] = TransactionResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function show($id)
    {
        abort(404);
        return view('transaction::vendor.transactions.show');
    }
}
