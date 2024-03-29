<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoices;
use App\Models\invoices as ModelsInvoices;

class Invoices_Report extends Controller
{
    public function index()
    {
        return view('reports.invoices_report');
    }

    public function Search_invoices(Request $request)
    {
        $rdio = $request->rdio;

        // في حالة البحث بنوع الفاتورة

        if ($rdio == 1) {
            // في حالة عدم تحديد تاريخ
            if ($request->type && $request->start_at == '' && $request->end_at == '') {

                $invoices = ModelsInvoices::select('*')->where('Status', '=', $request->type)->get();
                $type = $request->type;
                return view('reports.invoices_report', compact('type', 'invoices'));
            }

            // في حالة تحديد تاريخ استحقاق
            else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;

                $invoices = ModelsInvoices::whereBetween('invoice_Date', [$start_at, $end_at])->where('Status', '=', $request->type)->get();
                return view('reports.invoices_report', compact('type', 'start_at', 'end_at', 'invoices'));
            }
        }
        // البحث برقم الفاتورة
        else {
            $invoices = ModelsInvoices::select('*')->where('invoice_number', '=', $request->invoice_number)->get();
            return view('reports.invoices_report', compact('invoices'));
        }
    }
}
