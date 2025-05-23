<?php

namespace Modules\Order\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Order\Repositories\Dashboard\ReportRepository;
use Modules\Order\Transformers\Dashboard\CustomerSalesResource;
use Modules\Order\Transformers\Dashboard\OfferSalesResource;
use Modules\Order\Transformers\Dashboard\VenderSalesResource;

class ReportController extends Controller
{

    public function __construct(ReportRepository $repository)
    {
        $this->report = $repository;
    }

    public function vendors()
    {
        return view('order::dashboard.reports.vendors');
    }

    public function vendors_datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->report->QueryVendors($request));
        $datatable['data'] = VenderSalesResource::collection($datatable['data']);
        return Response()->json($datatable);
    }

    public function customers()
    {
        return view('order::dashboard.reports.customers');
    }

    public function customers_datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->report->QueryCustomers($request));
        $datatable['data'] = CustomerSalesResource::collection($datatable['data']);
        return Response()->json($datatable);
    }

    public function offers()
    {
        return view('order::dashboard.reports.offers');
    }

    public function offers_datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->report->QueryOffers($request));
        $datatable['data'] = OfferSalesResource::collection($datatable['data']);
        return Response()->json($datatable);
    }
}
