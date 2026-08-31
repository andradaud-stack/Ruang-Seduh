<?php



namespace App\Modules\Order_items\Models;



use App\Modules\Menus\Models\Menus;

use App\Modules\Orders\Models\Orders;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;





class Order_items extends Model

{

use SoftDeletes;



protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

protected $table      = 'order_items';

protected $fillable = [
    'order_id',
    'menu_id',
    'menu_name',
    'price',
    'qty',
    'subtotal',
    'created_by',
    'updated_by',
    'deleted_by',
];



public function order()

{

	return $this->belongsTo(Orders::class, 'order_id');

}



public function menu()

{

	return $this->belongsTo(Menus::class, 'menu_id');

}

}

