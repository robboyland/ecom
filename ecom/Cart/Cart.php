<?php

namespace Ecom\Cart;

use Illuminate\Session\Store;

class Cart
{
    /**
    * @var Storage system
    */
    protected $storage;

    /**
    * Cart constructor
    *
    * @param StorageInterface    $store      The interface for storing the cart data
    */
    public function __construct(Store $storage)
    {
        $this->storage = $storage;
    }

    /**
    * Add item to cart
    *
    * @param int    $id         Item id
    * @param string $name       Item name
    * @param int    $quantity   Item quantity
    * @param int    $price      Item price
    */
    public function add($id, $name, $quantity, $price)
    {
        $cart = $this->all();

        if (array_key_exists($id, $cart))
        {
            $qty = $cart[$id]['qty'];
            $quantity = $cart[$id]['qty'] = ++$qty;
        }

        $this->storage->put('cart.' . $id, ['name' => $name, 'qty' => $quantity, 'price' => $price]);
    }

    /**
    * Get cart from session storage
    *
    * @return array Items in session cart
    */
    public function all()
    {
        if ($this->storage->has('cart'))
        {
            return $this->storage->get('cart');
        }
        return [];
    }

    /**
    * Set the quantity of an item in the cart
    *
    * @return void
    */
    public function setQuantity($id, $quantity)
    {
        $cart = $this->all();

        $quantity = $cart[$id]['qty'] = $quantity;
    }

    /**
    * The total cost of all items in the cart
    *
    * @return int The total cost of items
    */
    function totalCost()
    {
        $total = 0;

        foreach ($this->storage->get('cart') as $item)
        {
            $total += $item['price'] * $item['qty'];
        }

        return $total;
    }

    /**
    * The total number of items in the cart
    *
    * @return int The total number of items
    */
    public function itemCount()
    {
        $total = 0;

        foreach ($this->items as $item)
        {
            $total += $item['quantity'];
        }

        return $total;
    }

    /**
     * Remove an item from cart
     *
     * @param  int $id Item id
     * @return void
     */
    public function removeItem($id)
    {
        $this->storage->forget('cart.' . $id);
    }

    /**
     * Remove all items from cart
     *
     * @return void
     */
    public function clear()
    {
        $this->storage->forget('cart');
    }
}
