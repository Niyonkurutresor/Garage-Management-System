<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class serviceController extends Controller
{
    public function allServicesPage(){
        $services = Service::all();
        return view('services',['services'=>$services]);
    }

    public function serviceRegistrationPage(){
        return view('createNewService');
    }

    public function registerNewService(Request $request){
        $newServiceValidatedInformation = $request->validate([
            'name' => 'required|string|max:255|unique:services',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        try{
            $user = Service::create([
                'name' => $newServiceValidatedInformation['name'],
                'price' => $newServiceValidatedInformation['price'],
                'description' => $newServiceValidatedInformation['description'], 
            ]);
    
            return redirect()->route('owner.dashboard')->with('success', 'Service registered successfully');
        }catch(\Exception $e){
            return back()->withInput()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }

    public function deleteService($id){
        Service::find($id)->delete();
        return redirect()->back()->with('success', 'Service deleted successfully.');
    }

    public function updateServicePage($id){
        $service= Service::find($id);
        return view('serviceUpdate',['service'=>$service]);
    }

    public function updateService(Request $request, $id){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
    
        $existingService = Service::where('name', $validatedData['name'])
            ->where('id', '!=', $id)
            ->exists();
    
        if ($existingService) {
            return back()->withErrors(['name' => 'The name has already been taken.'])->withInput();
        }
    
        $service = Service::findOrFail($id);
        $service->update($validatedData);
    
        return redirect()->route('all.services')->with('success', 'Service updated successfully');
    }
}
