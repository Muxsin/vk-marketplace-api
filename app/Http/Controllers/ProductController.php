<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ListProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(ListProductRequest $request)
    {
        $validated = $request->validated();

        return ProductResource::collection(
            Product::with('user')->where(
                function (Builder $query) use ($validated) {
                    if (isset($validated['filter_by'])) {
                        if (isset($validated['filter_exact'])) {
                            $query->where($validated['filter_by'], $validated['filter_exact']);
                        } else {
                            if (isset($validated['filter_min'])) {
                                $query->where($validated['filter_by'], '>=', $validated['filter_min']);
                            }

                            if (isset($validated['filter_max'])) {
                                $query->where($validated['filter_by'], '<=', $validated['filter_max']);
                            }
                        }
                    }
                }
            )
                ->orderBy($validated['sort_by'] ?? 'created_at', $validated['sort_type'] ?? 'desc')
                ->paginate()
        );
    }

    public function store(StoreProductRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $product = $user->products()->create($request->validated());

        return $product->fresh();
    }
}
