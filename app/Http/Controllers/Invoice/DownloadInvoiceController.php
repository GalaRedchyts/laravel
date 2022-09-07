<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Contracts\InvoicesServiceContract;
use Illuminate\Http\Request;

class DownloadInvoiceController extends Controller
{
    public function __invoke(Order $order, InvoicesServiceContract $invoicesServiceContract)
    {
        return $invoicesServiceContract->generate($order)->download();
    }
}
