<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitOrderRequest;
use App\Mail\NewOrder;

class OrderController extends Controller
{
	public function submit(SubmitOrderRequest $request)
	{
		// 'terms' is a fake field. Most of the bots will fill
		// this honey pot field, so we can just return
		// "Success" response to them
		if ($request->input('terms')) {
			return response()->json('Success');
		}

		$this->mailOrder($request->validated());

		return response()->json('Success');
    }

	protected function mailOrder($orderData)
	{
		\Mail::to(config('c.newOrderRecipient'))->send(new NewOrder($orderData));
    }
}
