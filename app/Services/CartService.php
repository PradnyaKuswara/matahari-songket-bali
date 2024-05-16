<?php

namespace App\Services;

use App\Interfaces\CartInterface;

class CartService
{
    protected $cartInterface;

    public function __construct(CartInterface $cartInterface)
    {
        $this->cartInterface = $cartInterface;
    }

    public function getCartByCustomer($user)
    {
        return $this->cartInterface->getCartByCustomer($user);
    }

    public function storeCartByCustomer(array $data, $user)
    {
        return $this->cartInterface->storeCartByCustomer($data, $user);
    }

    public function updateCartByCustomer(array $data, $user)
    {
        return $this->cartInterface->updateCartByCustomer($data, $user);
    }

    public function deleteCartByCustomer(array $data, $user)
    {
        return $this->cartInterface->deleteCartByCustomer($data, $user);
    }

    public function toggleCartByCustomer(array $data, $user)
    {
        return $this->cartInterface->toggleCartByCustomer($data, $user);
    }

    public function toggleCartByCustomerAll($data, $user)
    {
        return $this->cartInterface->toggleCartByCustomerAll($data, $user);
    }
}
