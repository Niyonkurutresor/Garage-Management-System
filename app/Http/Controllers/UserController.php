<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function ownerDashboardPage(){
        try {
            
            $totalInvoices = Invoice::count();
            $paidInvoices = Invoice::where('status', '=', 'Paid')->count();
            $unpaidInvoices = Invoice::where('status', '=', 'Unpaid')->count();
          
            $totalPaidRevenue = Invoice::where('status', '=', 'Paid')->sum('price');
            $totalUnpaidRevenue = Invoice::where('status', '=', 'Unpaid')->sum('price');
          
            $totalSales = $totalPaidRevenue + $totalUnpaidRevenue;
          
            if ($totalSales > 0) {
              $collectionEfficiency = round((($totalSales - $totalUnpaidRevenue) / $totalSales) * 100,2);
            } else {
              $collectionEfficiency = 0; 
            }

            $totalInvoices = Invoice::count();

            if ($totalInvoices === 0 || $totalSales === 0) {
            $averageInvoiceValue = 0; 
            } else {
            $averageInvoiceValue = $totalSales / $totalInvoices;
            }

            $serviceOccurrences = DB::table('invoice_service')
            ->select('services.name', DB::raw('count(*) as occurrences'))
            ->join('services', 'invoice_service.service_id', '=', 'services.id')
            ->groupBy('services.name')
            ->get();


            return view('dashboard', compact([
              'totalInvoices', 
              'paidInvoices', 
              'unpaidInvoices',
              'totalPaidRevenue',
              'totalUnpaidRevenue',
              'collectionEfficiency',
              'averageInvoiceValue',
              'totalSales',
              'serviceOccurrences',
            ]));
          
          } catch (QueryException $e) {
            
            report($e); 
            $error = 'An error occurred while retrieving data. Please try again later.';
            
            return view('dashboard', compact('error'));
          }
          
    }

    public function userRegistrationPage(){
        return view('userRegistration');
    }

    public function registeringNewUser(Request $request){

        $validatedUserInformation = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try{
            $user = User::create([
                'name' => $validatedUserInformation['name'],
                'email' => $validatedUserInformation['email'],
                'password' => Hash::make($validatedUserInformation['password']), 
            ]);
    
            return redirect()->route('owner.dashboard')->with('success', 'User registered successfully');
        }catch(\Exception $e){
            return back()->withInput()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }
}
