<?php

namespace App\Http\Livewire;

use App\Models\Food;
use App\Models\FoodOrder;
use Livewire\Component;
use Illuminate\Support\Collection;

class FoodList extends Component
{



    public $selected = [];
    public $perPage = 10;
    public $hasMorePages = true;
    public $price;




    public function add($index)
    {

        $this->selected['index' . $index]['qty'] = ($this->selected['index' . $index]['qty'] ?? 0) + 1;

        $this->price = 0;
        foreach ($this->selected as $key => $s) {


            $priceOfS = Food::find(substr($key, 5))->price;

            $qtyOfS = $s['qty'];
            $this->price +=  $priceOfS * $qtyOfS;
        }
        if ($this->price == 0) {
            $this->selected = [];
        }
    }
    public function subtract($index)
    {

        if (($this->selected['index' . $index]['qty'] ?? 0) > 0) {
            $this->selected['index' . $index]['qty'] = $this->selected['index' . $index]['qty']  - 1;
        }

        $this->price = 0;
        foreach ($this->selected as $key => $s) {


            $priceOfS = Food::find(substr($key, 5))->price;

            $qtyOfS = $s['qty'];
            $this->price +=  $priceOfS * $qtyOfS;
        }
        if ($this->price == 0) {
            $this->selected = [];
        }
    }


    public function loadFoods()
    {
        $this->perPage = $this->perPage + 5;
    }
    public function render()
    {


        $foods = Food::paginate($this->perPage);
        if ($foods->lastPage() > $foods->currentPage()) {
            $this->hasMorePages = true;
        } else {
            $this->hasMorePages = false;
        }



        return view('livewire.food-list', [
            'foods' => $foods,
        ]);
    }

    public function makeOrder()
    {
        if (!auth()->user()) {
            return redirect()->route('login');
        }


        $orderPrice = 0;
        $foods = [];
        foreach ($this->selected as $key => $s) {


            $priceOfS = Food::find(substr($key, 5))->price;

            $qtyOfS = $s['qty'];
            $orderPrice +=  $priceOfS * $qtyOfS;
            $foods[substr($key, 5)]['name'] = Food::find(substr($key, 5))->name;
            $foods[substr($key, 5)]['qty'] = $s['qty'];
            $foods[substr($key, 5)]['price'] = Food::find(substr($key, 5))->price;
        }

        $model = new FoodOrder();
        $model->user_id = auth()->user()->id;
        $model->price = $orderPrice;
        $model->foods = $foods;
        $model->save();

        return redirect()->route('food-order.show', $model->id);
    }
}
