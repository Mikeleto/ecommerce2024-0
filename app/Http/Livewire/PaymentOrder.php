<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PaymentOrder extends Component
{
    use AuthorizesRequests;

    public $order;

    protected $listeners = ['payOrder'];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

   // En el componente PaymentOrder.php

public function payOrder()
{
    $this->order->status = 2;
    $this->order->save();

    // Asociar productos con la orden
    $this->order->products()->attach($this->order->items);

    return redirect()->route('orders.show', $this->order);
}


    public function render()
    {
        $this->authorize('view', $this->order);

        $items = json_decode($this->order->content);
        $envio = json_decode($this->order->envio);

        return view('livewire.payment-order', compact('items', 'envio'));;
    }

    
}
