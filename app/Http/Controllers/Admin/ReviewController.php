<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function show(Review $review)
    {
        return view('admin.reviews.show', compact('review'));
    }

    public function approve(Review $review)
    {
        $review->is_approved = true;
        $review->save();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Отзыв одобрен и опубликован');
    }

    public function disapprove(Review $review)
    {
        $review->is_approved = false;
        $review->save();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Отзыв скрыт с сайта');
    }

    public function response(Request $request, Review $review)
    {
        $request->validate([
            'response' => 'nullable|string|max:2000',
        ]);

        $review->response = $request->response;
        $review->save();

        return redirect()->route('admin.reviews.show', $review)
            ->with('success', 'Ответ на отзыв сохранён');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')
            ->with('success', 'Отзыв удалён');
    }
}