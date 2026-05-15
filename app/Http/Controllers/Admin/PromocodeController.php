<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promocode;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    public function index()
    {
        $promocodes = Promocode::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.promocodes.index', compact('promocodes'));
    }

    public function create()
    {
        return view('admin.promocodes.create');
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'code' => 'required|string|max:50|unique:promocodes',
        'type' => 'required|in:percent,fixed',
        'value' => [
            'required',
            'numeric',
            'min:1',
            function ($attribute, $value, $fail) use ($request) {
                if ($request->type === 'percent' && $value > 100) {
                    $fail('Процентная скидка не может превышать 100%.');
                }
                if ($request->type === 'fixed' && $value > 999999) {
                    $fail('Фиксированная скидка не может превышать 999 999 ₽.');
                }
            },
        ],
        'min_order_amount' => 'nullable|numeric|min:0',
        'usage_limit' => 'nullable|integer|min:1',
        'expires_at' => 'nullable|date',
        'description' => 'nullable|string|max:500'
    ]);

    Promocode::create([
        'code' => strtoupper($validated['code']),
        'type' => $validated['type'],
        'value' => $validated['value'],
        'min_order_amount' => $validated['min_order_amount'] ?? 0,
        'usage_limit' => $validated['usage_limit'] ?? 1,
        'expires_at' => $validated['expires_at'] ?? null,
        'description' => $validated['description'] ?? null,
        'is_active' => true,
        'used_count' => 0
    ]);

    return redirect()->route('admin.promocodes.index')
        ->with('success', 'Промокод успешно создан');
}

    public function edit(Promocode $promocode)
    {
        return view('admin.promocodes.edit', compact('promocode'));
    }

    public function update(Request $request, Promocode $promocode)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:promocodes,code,' . $promocode->id,
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0|max:100',
            'min_order_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'expires_at' => 'nullable|date',
            'is_active' => 'nullable|boolean',
            'description' => 'nullable|string|max:500'
        ]);

        $promocode->update([
            'code' => strtoupper($validated['code']),
            'type' => $validated['type'],
            'value' => $validated['value'],
            'min_order_amount' => $validated['min_order_amount'] ?? 0,
            'usage_limit' => $validated['usage_limit'] ?? 1,
            'expires_at' => $validated['expires_at'] ?? null,
            'is_active' => $request->has('is_active'),
            'description' => $validated['description'] ?? null
        ]);

        return redirect()->route('admin.promocodes.index')
            ->with('success', 'Промокод успешно обновлен');
    }

    public function destroy(Promocode $promocode)
    {
        $promocode->delete();
        return redirect()->route('admin.promocodes.index')
            ->with('success', 'Промокод удален');
    }

    public function toggleStatus(Promocode $promocode)
    {
        $promocode->update(['is_active' => !$promocode->is_active]);
        return redirect()->back()->with('success', 'Статус промокода изменен');
    }
}