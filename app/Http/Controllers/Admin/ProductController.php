<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flower;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Flower::with('category')->paginate(10);
        return view('admin.products.index', compact('products'));
    }
    
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'in_stock' => 'boolean',
            'quantity' => 'integer|min:0'
        ]);
        
        // Загрузка главного изображения
        $mainImagePath = $request->file('main_image')->store('products', 'public');
        
        // Создание товара
        $product = Flower::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image_path' => $mainImagePath,
            'in_stock' => $request->has('in_stock'),

        ]);
        
        // Загрузка дополнительных изображений
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $index => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'flower_id' => $product->id,
                    'image_path' => $path,
                    'sort_order' => $index,
                    'is_primary' => false
                ]);
            }
        }
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успешно создан');
    }
    
    public function edit(Flower $product)
    {
        $categories = Category::all();
        $additionalImages = $product->images;
        return view('admin.products.edit', compact('product', 'categories', 'additionalImages'));
    }
    
     public function update(Request $request, Flower $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'in_stock' => 'boolean'
        ]);
        
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'in_stock' => $request->has('in_stock')
        ];
        
        // Обработка нового изображения
        if ($request->hasFile('image')) {
            // Удаляем старое, если есть
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }
            
            // Сохраняем новое
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('products', $filename, 'public');
            $data['image_path'] = $path;
        }
        
        $product->update($data);
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Товар "' . $product->name . '" успешно обновлен');
    }

    
    public function destroy(Flower $product)
    {
        // Удаляем все изображения
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        
        $product->delete();
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Товар удален');
    }
    
    // Удаление дополнительного изображения
    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        
        return response()->json(['success' => true]);
    }
}