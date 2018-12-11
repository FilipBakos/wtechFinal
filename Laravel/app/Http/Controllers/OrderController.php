<?php

namespace App\Http\Controllers;

use App;
use App\Order;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Item;

class OrderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showBasket()
    {
        $user = Auth::user();
        $items = $user->items()->get();
        //dd($items);
        return view('layouts/basket')
            ->with('items', $items);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToBasket(Request $request)
    {
        $user = Auth::user();
        $item = Item::find($request->segment(2));
        if($user->items()->where('id',$item->id)->exists()) {
            flash('Tuto polozku uz mate v kosiku')->error();
            return back();
        }
        else {
            flash()->success('Tato polozka bola pridana do kosika');
            $user->items()->save($item,['number_of_items' => $request->input('number_of_products')]);
        }


        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function removeFromBasket(Request $request)
    {

        $user = Auth::user();
        $item = Item::find($request->segment(3));

        flash('Tato polozka bola odstranena z kosika')->success();
        $user->items()->detach($item);

        return $this->showBasket();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showOrderForm()
    {
        $user = Auth::user();
        return view('layouts/objednavka')
            ->with('user', $user);
    }

    public function showMethods(Request $request)
    {
        $order = $this->createOrder($request);
        $order->save();
        return view('layouts/methods')
            ->with('order',$order);
    }

    /**
     * @param Request $request
     */
    public function createOrder(Request $request)
    {
        $order = new Order;
        $user = Auth::user();

        $order->user_id = $user->id;
        $order->first_name = $request->input('first_name');
        $order->second_name = $request->input('second_name');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->street = $request->input('street');
        $order->city = $request->input('city');
        $order->psc = $request->input('psc');
        $order->house_number = $request->input('house_number');
        $order->price = $this->sumPrice($user);
        $order->payed = false;
        $order->payment_method = '';
        $order->logistic_method = '';
        $order->done = false;
        return $order;
    }

    /**
     * @param User $user
     * @return float|int
     */
    public function sumPrice(User $user)
    {
        $items = $user->items;
        $sum = 0;
        foreach ($items as $item) {
            $sum += $item->price * $item->pivot->number_of_items;
        }

        return $sum;
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSum(Request $request)
    {

        $items = Auth::user()->items()->get();

        Order::where('id',$request->segment(2))->update(array(
            'logistic_method' => $request->input('logistic'),
            'payment_method'  => $request->input('payment')
        ));

        $order = Order::find($request->segment(2));
        return view('layouts/summary')
            ->with('order',$order)
            ->with('items', $items);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmOrder(Request $request)
    {
        $order = Order::find($request->segment(2));
        $user = Auth::user();
        $items = $user->items()->get();

        foreach ($items as $item) {
            $this->updateNumber($item);
            $order->items()->save($item,['number' => $item->pivot->number_of_items]);
            $user->items()->detach($item);
        }

        Order::where('id',$request->segment(2))->update(array(
                'done' => true
        ));

        flash('Na váš email bolo zaslané potvrdenie o objednávke')->success();
        return redirect('/');
    }

    public function updateNumber(Item $item)
    {
        $itemOld = Item::find($item->id);

        $newNumber = $itemOld->number - $item->pivot->number_of_items;
        Item::where('id',$item->id)->update(array(
            'number' => $newNumber
        ));
    }

}
