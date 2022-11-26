<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'membership_id' => 'required|integer|exists:memberships,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $subs = new Subscription();
        $subs->user_id = $request->user_id;
        $subs->membership_id = $request->membership_id;
        $subs->subscribe_from = now();
        $subs->subscribe_till = now()->addMonth();
        $subs->save();

        return $this->sendResponse($subs, 'Subscribe successfully.');
    }

    public function unSubscribe($id)
    {
        $subs = Subscription::findOrFail($id);
        $subs->is_subscribed = 0;
        $subs->save();

        return $this->sendResponse($subs, 'Unsubscribe successfully.');
    }
}
