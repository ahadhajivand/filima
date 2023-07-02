<?php

namespace App\Servics\Cart;

use Illuminate\Support\Facades\Facade;

/**
 * @method static put(array $value , $obj)
 * @method static get($obj)
 *  @method static all()
 *  @method static has($obj)
 * @method static delete($obj)
 */
class Cart extends Facade
{
   protected static function getFacadeAccessor()
   {
       return 'cart';
   }
}
