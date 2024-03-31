<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Customer;
use Carbon\Carbon;
use Validator;
use DB;
use App\Http\Resources\Custwall as CustwallResource;

class CustomerController extends BaseController
{
    public function index()
    {
        $customers = Customer::with('wallet')->get();
        return $this->sendResponse(new CustwallResource($customers), 'all customer retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input       =  $request->all(); 
        $validator   =  Validator::make($input, [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'full_address' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }else{
            $customer = Customer::create($request->all());
            $customer->wallet()->create(['balance' => 0]);
            return $this->sendResponse(new CustwallResource($customer), 'customer created successfully.');
        }
    }

    public function show($id)
    {
        $customer = Customer::with('wallet')->find($id);
        if($customer){
            return $this->sendResponse(new CustwallResource($customer), 'customer retrieved successfully.');
        }else{
            return $this->sendError('not found.', 'customer not found');     
        }
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        if($customer){
            return $this->sendResponse(new CustwallResource($customer), 'customer retrieved successfully.');
        }else{
            return $this->sendError('not found.', 'customer not found');     
        }
    }

    public function update(Request $request, int $id)
    {
        $input       =  $request->all(); 
        $validator   =  Validator::make($input, [
            'edit_first_name' => 'required|string|max:50',
            'edit_last_name' => 'required|string|max:50',
            'edit_full_address' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }else{
            $customer = Customer::find($id);
            if($customer){
                $customer->update([
                    'first_name' => $request->edit_first_name,
                    'last_name' => $request->edit_last_name,
                    'full_address' => $request->edit_full_address
                ]);
                return $this->sendResponse(new CustwallResource($customer), 'customer updated successfully.');
            }else{
                return $this->sendError('not found', 'customer not found');    
            }
        }
    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        if($customer){
            $delete = $customer->delete();
            if($delete==true){
                $data_response['id'] = $customer->id;
                $message             = 'customer made soft deleted successfully.'; 
            }else{
                $data_response['id'] = $customer->id;
                $message             = 'something went wrong.';     
            }
        }else{
            $data_response['id'] = $id;
            $message             = 'this id not exist.';   
        }
        return $this->sendResponse($data_response, $message);        
    }

    public function restore($id)
    {
        $customer = Customer::withTrashed()->find($id);
        if (!$customer) {
            return $this->sendError('not found', 'customer not found');    
        }
        $customer->restore();
        return $this->sendResponse(new CustwallResource($customer), 'Customer restored successfully.');
    }

    public function addBalance(Request $request, $customerId)
    {
        $customer = Customer::find($customerId);
        if (!$customer) {
            return $this->sendError('not found', 'customer not found');  
        }
        $wallet = $customer->wallet;

        if (!$wallet) {
            return $this->sendError('not found', 'Customer does not have a wallet');
        }
        $amountToAdd = $request->input('amount');
        $wallet->balance += $amountToAdd;
        $wallet->save();
        return $this->sendResponse(new CustwallResource(['balance' => $wallet->balance]), 'balance added successfully');
    }

    public function deductBalance(Request $request, $customerId)
    {
        $customer = Customer::find($customerId);
        if (!$customer) {
            return $this->sendError('not found', 'customer not found');  
        }
        $wallet = $customer->wallet;

        if (!$wallet) {
            return $this->sendError('not found', 'Customer does not have a wallet');
        }
        $amountToDeduct = $request->input('amount');
        if ($wallet->balance < $amountToDeduct) {
            return $this->sendError('error', 'insufficient balance', 200);
        }
        $wallet->balance -= $amountToDeduct;
        $wallet->save();
        return $this->sendResponse(new CustwallResource(['balance' => $wallet->balance]), 'balance deducted successfully');
    }

}
