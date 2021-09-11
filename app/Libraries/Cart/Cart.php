<?php


namespace App\Libraries\Cart;


class Cart
{
    /**
     * @return array
     */
    public static function getCart()
    {
        $cart = self::cartGet();

        return is_array($cart) ? $cart : [];
    }

    /**
     * @param integer $productId
     * @return boolean
     */
    public static function addProduct($productId)
    {
        $productId = (int)$productId;

        $cart = self::getCart();

        if (self::hasProduct($productId)) {
            $cart[$productId]['quantity']++;

            self::cartPut($cart);

            session()->flash('success', 'Product incremented in cart successfully!');
            return true;
        }

        $cart[$productId] = self::createProduct();

        self::cartPut($cart);

        session()->flash('success', 'Product added to cart successfully!');
        return true;
    }

    /**
     * @param integer $productId
     * @param integer $quantity
     * @return boolean
     */
    public static function updateProduct($productId, $quantity)
    {
        $productId = (int)$productId;
        $quantity = (int)$quantity;

        if (!self::hasProduct($productId)) {
            return false;
        }

        $cart = self::getCart();
        $cart[$productId]['quantity'] = $quantity;
        self::cartPut($cart);

        session()->flash('success', 'Cart updated successfully');

        return true;
    }

    /**
     * @param integer $productId
     * @return boolean
     */
    public static function removeProduct($productId)
    {
        $productId = (int)$productId;

        if (!self::hasProduct($productId)) {
            return false;
        }

        $cart = self::getCart();
        unset($cart[$productId]);
        self::cartPut($cart);

        session()->flash('success', 'Product removed successfully');

        return true;
    }

    /**
     * @param integer $productId
     * @return boolean
     */
    private static function hasProduct($productId)
    {
        $cart = self::getCart();

        return array_key_exists($productId, $cart);
    }

    /**
     * @return array
     */
    private static function createProduct()
    {
        return [
            'title' => 'Product Title',
            'price' => 50,
            'quantity' => 1
        ];
    }

    /**
     * @return array
     */
    private static function cartGet()
    {
        return session()->get('cart');
    }

    /**
     * @param array $cart
     * @return void
     */
    private static function cartPut($cart)
    {
        session()->put('cart', $cart);
    }
}
