<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MembershipController extends Controller
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

    public function index()
    {
        $membership = Membership::paginate();

        return $this->sendResponse($membership, 'Membership Plan retrieved successfully.');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan' => 'required',
            'amount' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $membership = new Membership();
        $membership->plan = $request->plan;
        $membership->amount = $request->amount;
        $membership->save();

        return $this->sendResponse($membership, 'Membership plan created successfully.');
    }

    public function update(Request $request, $id)
    {
        $membership = Membership::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'plan' => 'required',
            'amount' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $membership->plan = $request->plan;
        $membership->amount = $request->amount;
        $membership->save();

        return $this->sendResponse($membership, 'Membership plan updated successfully.');
    }

    public function destroy($id)
    {
        Membership::findOrFail($id)->delete();

        return $this->sendResponse([], 'Membership plan deleted successfully.');
    }
}
