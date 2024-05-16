<?php

namespace App\Interfaces;

interface CartInterface
{
    public function getCartByCustomer($user);

    public function storeCartByCustomer(array $data, $user);

    public function updateCartByCustomer(array $data, $user);

    public function deleteCartByCustomer(array $data, $user);

    public function toggleCartByCustomer(array $data, $user);

    public function toggleCartByCustomerAll($data, $user);
}
