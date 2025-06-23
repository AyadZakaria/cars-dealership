<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:255',
        ]);
        Customer::create($validated);
        ToastMagic::success('Customer created successfully.');
        return redirect()->route('admin.customers.index');
    }

    public function show(Customer $customer)
    {
        return view('admin.customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|max:255',
        ]);
        $customer->update($validated);
        ToastMagic::success('Customer updated successfully.');
        return redirect()->route('admin.customers.index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        ToastMagic::success('Customer deleted successfully.');
        return redirect()->route('admin.customers.index');
    }
}
