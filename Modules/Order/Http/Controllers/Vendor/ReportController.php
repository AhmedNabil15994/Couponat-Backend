<?php

namespace Modules\Order\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Order\Repositories\Vendor\ReportRepository;
use Modules\Order\Transformers\Vendor\CustomerSalesResource;
use Modules\Order\Transformers\Vendor\OfferSalesResource;
use Modules\Order\Transformers\Vendor\VenderSalesResource;

class ReportController extends Controller
{

    public function __construct(ReportRepository $repository)
    {
        $this->report = $repository;
    }

    public function vendors()
    {
        return view('order::vendor.reports.vendors');
    }

    public function vendors_datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->report->QueryVendors($request));
        $datatable['data'] = VenderSalesResource::collection($datatable['data']);
        return Response()->json($datatable);
    }

    public function customers()
    {
        return view('order::vendor.reports.customers');
    }

    public function customers_datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->report->QueryCustomers($request));
        $datatable['data'] = CustomerSalesResource::collection($datatable['data']);
        return Response()->json($datatable);
    }

    public function offers()
    {
        return view('order::vendor.reports.offers');
    }

    public function offers_datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->report->QueryOffers($request));
        $datatable['data'] = OfferSalesResource::collection($datatable['data']);
        return Response()->json($datatable);
    }
}
