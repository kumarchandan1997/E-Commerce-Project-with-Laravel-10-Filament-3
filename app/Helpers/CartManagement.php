<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{

    //add item to cart
    static public function addItemToCart($product_id)
    {
      $cart_items = self::getcartItemsFromCookie();

      $existing_item = null;

      foreach($cart_items as $key => $item)
      {
        if($item['product_id'] == $product_id)
        {
            $existing_item = $key;
            break;
        }
      }

      if($existing_item !== null)
      {
        $cart_items[$existing_item]['quantity']++;
        $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
      }else{
        $product = Product::where('id',$product_id)->first(['id','name','price','images']);
        if($product)
        {
            $cart_items[] = [
               'product_id' => $product_id,
               'name' => $product->name,
               'image' => $product->images[0],
               'quantity' => 1,
               'unit_amount' => $product->price,
               'total_amount' => $product->price,
            ];
        }
      }

      self::addcartItemsToCookie($cart_items);
      return count($cart_items);

    }

    // add cart item with quantity

    static public function addItemToCartWithQuantity($product_id,$qty=1)
    {
      $cart_items = self::getcartItemsFromCookie();

      $existing_item = null;

      foreach($cart_items as $key => $item)
      {
        if($item['product_id'] == $product_id)
        {
            $existing_item = $key;
            break;
        }
      }

      if($existing_item !== null)
      {
        $cart_items[$existing_item]['quantity'] = $qty;
        $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
      }else{
        $product = Product::where('id',$product_id)->first(['id','name','price','images']);
        if($product)
        {
            $cart_items[] = [
               'product_id' => $product_id,
               'name' => $product->name,
               'image' => $product->images[0],
               'quantity' => $qty,
               'unit_amount' => $product->price,
               'total_amount' => $product->price,
            ];
        }
      }

      self::addcartItemsToCookie($cart_items);
      return count($cart_items);

    }

    // remove item from cart

    static public function removeItemFromCart($product_id)
    {
        $cart_items = self::getcartItemsFromCookie();

        foreach($cart_items as $key => $item)
        {
            if($item['product_id'] == $product_id)
            {
                unset($cart_items[$key]);
            }
        }

        self::addcartItemsToCookie($cart_items);
        return $cart_items;
    }

    //add cart item to cookie
    static public function addcartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items',json_encode($cart_items),60*24*30);
    }

    //clear cart item from cookie

    static public function clearCartItems()
    {
        cookie::queue(Cookie::forget('cart_items'));
    }

    // get all cart item from cookie
    static public function getcartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'),true);
        if(!$cart_items){
            $cart_items=[];
        }
        return $cart_items;
    }

    // increase item quantity

    static public function incrementQuantityToCartItem($product_id)
    {
        $cart_items = self::getcartItemsFromCookie();

        foreach($cart_items as $key => $item)
        {
            if($item['product_id'] == $product_id)
            {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
            }
        }
        self::addcartItemsToCookie($cart_items);
        return $cart_items;
    }

    //decrese item quantity

    static public function decreaseQuantityToCartItem($product_id)
    {
        $cart_items = self::getcartItemsFromCookie();

        foreach($cart_items as $key => $item)
        {
            if($item['product_id'] == $product_id)
            {
                if($cart_items[$key]['quantity'] > 1){
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                }
            }
        }
        self::addcartItemsToCookie($cart_items);
        return $cart_items;
    }

    //calculate grand sum
    static public function calculateGrandTotal($items)
    {
        return array_sum(array_column($items,'total_amount'));
    }
}

?>
