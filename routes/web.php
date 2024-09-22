<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\loginController;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('owner_dashboard');
    }
    return view('welcome');
});

Route::post('login',[loginController::class,'userAuthentication'])->name('login');

Route::get('login',[loginController::class,'login'])->name('login.index');

Route::middleware(['auth'])->group(function () {

Route::get('logout',[loginController::class,'logout'])->name('logout');    

Route::get('owner_dashboard',[userController::class,'ownerDashboardPage'])->name('owner.dashboard');

Route::get('user_registration',[userController::class,'userRegistrationPage'])->name('user.registration');

Route::get('all_invoices',[invoiceController::class,'allInvoicesPage'])->name('all.invoices');

Route::get('all_services',[serviceController::class,'allServicesPage'])->name('all.services');

Route::post('registering_new_user', [UserController::class, 'registeringNewUser'])->name('register.user');

Route::get('service_registration',[serviceController::class,'serviceRegistrationPage'])->name('register.service.page');

Route::post('registering_new_service',[serviceController::class,'registerNewService'])->name('register.service');

Route::get('create_invoice',[invoiceController::class,'createInvoicePage'])->name('create.invoice.page');

Route::post('create_invoice',[invoiceController::class,'createInvoice'])->name('create.invoice');

Route::get('delete_service/{id}',[serviceController::class,'deleteService'])->name('delete.service');

Route::get('services/{id}', [ServiceController::class, 'updateServicePage'])->name('edit.service.index');

Route::put('update_service/{id}', [ServiceController::class, 'updateService'])->name('update.service');

Route::get('delete_invoice/{id}',[invoiceController::class,'deleteInvoice'])->name('delete.invoice');

Route::get('invoice_details/{id}',[invoiceController::class,'invoiceDetails'])->name('view.invoice.details');

Route::get('invoice/{id}',[invoiceController::class,'invoiceUpdatePage'])->name('edit.invoice');

Route::put('update_invoice/{id}',[invoiceController::CLASS,'updateInvoice'])->name('update.invoice');

});