<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\notification;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function checkEwalletBalance()
    {
        $user = Auth::user();

        if ($user->ewallet_balance < 10) {
            // Create a new notification if balance is below RM10
            DB::table('notification')->insert([
                'user_id' => $user->id,
                'notification_info' => 'topup',
                'booking_id' => null,
                'work_description_id' => null,
                'job_request_id' => null,
                'bids_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return response()->json(['status' => 'checked']);
    }
}
