<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'brand' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'year' => 'required|integer',
                'price' => 'nullable|numeric|min:0',
                'purchase_price' => 'nullable|numeric|min:0',
                'availability' => 'required|in:for_rent,for_sale',
                'fuel_type' => 'required|in:petrol,diesel,electric,hybrid',
                'image' => 'nullable|image|max:4096',
                'mileage' => 'nullable|integer|min:0',
                'in_service' => 'nullable|boolean',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            ToastMagic::error($e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('cars', 'public');
            // Generate public URL for local storage
            $imageUrl = Storage::url($path);
        }

        $car = Car::create([
            'uuid' => Str::uuid(),
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'year' => $validated['year'],
            'price' => $validated['price'] ?? null,
            'purchase_price' => $validated['purchase_price'] ?? null,
            'availability' => $validated['availability'],
            'fuel_type' => $validated['fuel_type'],
            'image_url' => $imageUrl,
            'mileage' => $validated['mileage'] ?? 0,
            'in_service' => $request->has('in_service') ? true : false,
            'created_by' => Auth::check() ? Auth::user()->id : null,
        ]);

        ToastMagic::success('Car created successfully.');
        return redirect()->route('admin.cars.index');
    }

    public function show(Car $car)
    {
        return view('admin.cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        try {
            $validated = $request->validate([
                'brand' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'year' => 'required|integer',
                'price' => 'nullable|numeric|min:0',
                'purchase_price' => 'nullable|numeric|min:0',
                'availability' => 'required|in:for_rent,for_sale',
                'fuel_type' => 'required|in:petrol,diesel,electric,hybrid',
                'image' => 'nullable|image|max:4096',
                'mileage' => 'nullable|integer|min:0',
                'in_service' => 'nullable|boolean',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            ToastMagic::error($e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $imageUrl = $car->image_url;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('cars', 'public');
            $imageUrl = Storage::url($path);
        }

        $car->update([
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'year' => $validated['year'],
            'price' => $validated['price'] ?? null,
            'purchase_price' => $validated['purchase_price'] ?? null,
            'availability' => $validated['availability'],
            'fuel_type' => $validated['fuel_type'],
            'image_url' => $imageUrl,
            'mileage' => $validated['mileage'] ?? 0,
            'in_service' => $request->has('in_service') ? true : false,
        ]);

        ToastMagic::success('Car updated successfully.');
        return redirect()->route('admin.cars.index');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        ToastMagic::success('Car deleted successfully.');
        return redirect()->route('admin.cars.index');
    }
}
