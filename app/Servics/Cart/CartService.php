<?php

namespace App\Servics\Cart;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CartService
{
   protected $cart;

   public function __construct()
   {
       $this->cart = session()->get('cart') ?? collect([]);
   }

    public function put(array $value , $obj = null)
    {
       if (! is_null($obj) && $obj instanceof Model)
       {
           $value = array_merge($value , [
              'id' => Str::random(10) ,
              'subject_id' => $obj->id ,
              'subject_type' => get_class($obj)
           ]);
       }else{
           $value = array_merge($value , [
               'id' => Str::random(10) ,
           ]);
       }
       $this->cart->put($value['id'] , $value);
       session()->put('cart' , $this->cart);

       return $this;
    }

    public function has($key)
    {
        if ($key instanceof Model)
        {
            return ! is_null(
                $this->cart->where('subject_id' , $key->id)->where('subject_type' , get_class($key))->first()
            );
        }
        return !is_null(
            $this->cart->firstWhere('id' , $key)
        );
    }

    public function get($key)
    {
        $item = $key instanceof Model
               ? $this->cart->where('subject_id' , $key->id)->where('subject_type' , get_class($key))->first()
               :       $this->cart->firstWhere('id' , $key);

        return $this->RelationModel($item);
    }

    public function all()
    {
        $cart = $this->cart;
        $cart = $cart->map(function ($item)
        {
           return $this->RelationModel($item);
        });
        return $cart;
    }


    public function delete($key)
    {
        if ($this->has($key))
        {
            $this->cart = $this->cart->filter(function ($item) use ($key){
                if ($key instanceof Model)
                {
                    return ($item['subject_id'] !=  $key->id) && ($item['subject_type'] != get_class($key));

                }
                return $item['id'] != $key;
            });
            session()->put('cart' , $this->cart);
            return true;
        }
    }

    public function RelationModel(mixed $item)
    {
        if (isset($item['subject_id']) && isset($item['subject_type']))
        {
            $class = $item['subject_type'];
            $obj = new $class;
            $object = $obj->find($item['subject_id']);
            $item[strtolower(class_basename($class))] = $object;
            return $item;
        }
        return $item;
    }


}
