<?php

namespace App\Repositories;

use App\Interfaces\CartInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartRepository implements CartInterface
{
    public function getCartByCustomer($user)
    {
        return $user->carts;
    }

    public function getCartActiveByCustomer($user)
    {
        return $user->load(['carts' => function ($query) {
            $query->wherePivot('is_active', true);
        }]);
    }

    public function storeCartByCustomer(array $data, $user)
    {
        DB::beginTransaction();

        try {
            // Store the cart data & check if the attach avaliable, update quantity
            $existingCart = $user->carts()->where('product_id', $data['product_id'])->first();

            if ($existingCart) {
                (int) $existingQuantity = (int) $existingCart->pivot->quantity;
                (int) $newQuantity = $existingQuantity + (int) $data['quantity'];
                $productStock = (int) Product::find($data['product_id'])->stock;

                if ($newQuantity > $productStock) {
                    DB::rollBack();
                    $message = 'The quantity of the product is not enough to add. Please check your cart and try again.';

                    return $response = [
                        'status' => 'error',
                        'message' => $message,
                        'user' => null,
                    ];
                }

                $user->carts()->updateExistingPivot($data['product_id'], ['quantity' => $newQuantity, 'is_active' => true]);
            } else {
                $user->carts()->attach($data['product_id'], ['quantity' => $data['quantity'], 'is_active' => true]);
            }

            DB::commit();

            return
                $response = [
                    'status' => 'success',
                    'message' => 'Product added to cart successfully',
                    'user' => $user,
                ];
        } catch (\Throwable $th) {
            DB::rollBack();

            return $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
                'user' => null,
            ];
        }
    }

    public function updateCartByCustomer(array $data, $user)
    {
        DB::beginTransaction();

        try {
            (int) $newQuantity = (int) $data['quantity'];

            if ($newQuantity > (int) Product::find($data['product_id'])->stock) {
                DB::rollBack();
                $message = 'The quantity of the product is not enough to update. Please check your cart and try again.';

                return $response = [
                    'status' => 'error',
                    'message' => $message,
                    'user' => null,
                ];
            }
            $user->carts()->updateExistingPivot($data['product_id'], ['quantity' => $newQuantity]);

            DB::commit();

            return
                $response = [
                    'status' => 'success',
                    'message' => 'Product updated successfully',
                    'user' => $user,
                ];
        } catch (\Throwable $th) {
            DB::rollBack();

            return $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
                'user' => null,
            ];
        }
    }

    public function deleteCartByCustomer(array $data, $user)
    {
        DB::beginTransaction();

        try {
            $user->carts()->detach($data['product_id']);

            DB::commit();

            return
                $response = [
                    'status' => 'success',
                    'message' => 'Product deleted successfully',
                    'user' => $user,
                ];
        } catch (\Throwable $th) {
            DB::rollBack();

            return $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
                'user' => null,
            ];
        }
    }

    public function toggleCartByCustomer(array $data, $user)
    {
        DB::beginTransaction();

        try {
            $existingCart = $user->carts()->where('product_id', $data['product_id'])->first();

            if (! $existingCart) {
                DB::rollBack();
                $message = 'The product is not in the cart';

                return $response = [
                    'status' => 'error',
                    'message' => $message,
                    'user' => null,
                ];
            }

            $user->carts()->updateExistingPivot($data['product_id'], ['is_active' => ! $existingCart->pivot->is_active]);

            DB::commit();

            return
                $response = [
                    'status' => 'success',
                    'message' => 'Product active successfully',
                    'user' => $user,
                ];
        } catch (\Throwable $th) {
            DB::rollBack();

            return $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
                'user' => null,
            ];
        }
    }

    public function toggleCartByCustomerAll($data, $user)
    {
        DB::beginTransaction();

        try {
            foreach ($user->carts as $cart) {
                $cart->pivot->is_active = $data;
                $cart->pivot->save();
            }

            DB::commit();

            return
                $response = [
                    'status' => 'success',
                    'message' => 'All product active successfully',
                    'user' => $user,
                ];
        } catch (\Throwable $th) {
            DB::rollBack();

            return $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
                'user' => null,
            ];
        }
    }

    public function updateCartStatusBaseOnStock($user)
    {
        DB::beginTransaction();

        try {
            foreach ($user->carts as $cart) {
                $productStock = (int) Product::find($cart->id)->stock;

                if ($productStock === 0) {
                    $this->deleteCartByCustomer(['product_id' => $cart->id], $user);
                } elseif ($cart->pivot->quantity > $productStock) {
                    $cart->pivot->quantity = $productStock;
                    $cart->pivot->save();
                }
            }

            DB::commit();

            return
                $response = [
                    'status' => 'success',
                    'message' => 'Cart status updated successfully',
                    'user' => $user,
                ];
        } catch (\Throwable $th) {
            DB::rollBack();

            return $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
                'user' => null,
            ];
        }
    }
}
