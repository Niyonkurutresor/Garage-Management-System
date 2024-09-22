<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class invoiceController extends Controller
{
    public function allInvoicesPage(){
        $invoices = Invoice::all();
        return view('invoices',['invoices'=>$invoices]);
    }

    public function createInvoicePage(){
        $services = Service::select('id','name','price')->get();
        return view('createInvoice',['services'=>$services]);
    }

    public function createInvoice(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'service' => 'required|array',
            'service.*' => 'exists:services,id', 
            'date' => 'required|date',
            'status' => 'required|in:paid,unpaid',
            'price' => 'required|numeric|min:0',
        ]);
        
        try {
            
            $invoiceNumber = mt_rand(100000, 999999);
            while (DB::table('invoices')->where('invoice_number', $invoiceNumber)->exists()) {
                $invoiceNumber = mt_rand(100000, 999999);
            }
            
            $invoice = new Invoice();
            $invoice->customer_name = $validatedData['customer_name'];
            $invoice->customer_phone = $validatedData['customer_phone'];
            $invoice->date = $validatedData['date'];
            $invoice->status = $validatedData['status'];
            $invoice->price = $validatedData['price'];
            $invoice->invoice_number = $invoiceNumber;
            $invoice->save();

            $invoice->services()->attach($validatedData['service']);

            return redirect()->route('owner.dashboard')->with('success', 'Invoice created successfully');
        } catch (\Exception $e) {
            
            return back()->withInput()->withErrors(['error' => 'Error creating invoice. Please try again.']);
        }
    }

    public function deleteInvoice($id){
        Invoice::find($id)->delete();
        return redirect()->back()->with('message', 'Invoice is deleted successfully.');
    }

    public function invoiceDetails($id){
        $invoices = DB::table('invoices')
        ->join('invoice_service', 'invoices.id', '=', 'invoice_service.invoice_id')
        ->join('services', 'invoice_service.service_id', '=', 'services.id')
        ->select('invoices.*', 'services.name as service_name', 'services.price as service_price')
        ->where('invoices.id', $id)
        ->get();
        return view('invoiceDetails',['invoices'=>$invoices]);
    }

    public function invoiceUpdatePage($id){
        $invoice = Invoice::findOrFail($id);
        $services = Service::all();
        return view('invoiceUpdate',['invoice'=>$invoice,'services'=>$services]);
    }

    public function updateInvoice(Request $request, $id)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'service' => 'required|array',
            'service.*' => 'exists:services,id',
            'date' => 'required|date',
            'status' => 'required|in:paid,unpaid',
            'price' => 'required|numeric|min:0',
        ]);

        try {
            $invoice = Invoice::findOrFail($id);

            $invoice->customer_name = $validatedData['customer_name'];
            $invoice->customer_phone = $validatedData['customer_phone'];
            $invoice->date = $validatedData['date'];
            $invoice->status = $validatedData['status'];
            $invoice->price = $validatedData['price'];

            // Update invoice services
            $invoice->services()->sync($validatedData['service']);

            $invoice->save();

            return redirect()->route('owner.dashboard')->with('success', 'Invoice updated successfully');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Error updating invoice. Please try again.']);
        }
    }
}
