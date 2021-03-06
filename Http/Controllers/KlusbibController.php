<?php

namespace Modules\Klusbib\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Klusbib\Models\Api\Stat;

class KlusbibController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $monthlyStats = Stat::monthly();
//        \Log::debug('Klusbib Dashboard: monthly stats=' . var_dump($monthlyStats));
        $counts['user'] = isset($monthlyStats["user"]) ? $monthlyStats["user"]["total-count"] : "0";
        $counts['user_active'] = isset($monthlyStats["user"]) ? $monthlyStats["user"]["active-count"] : "0";
        $counts['user_expired'] = isset($monthlyStats["user"]) ? $monthlyStats["user"]["expired-count"] : "0";
        $counts['user_deleted'] = isset($monthlyStats["user"]) ? $monthlyStats["user"]["deleted-count"] : "0";
        $counts['user_stroom'] = isset($monthlyStats["user"]) && isset($monthlyStats["user"]["stroom"]) ?
            $monthlyStats["user"]["stroom"]["total-count"] : "0";
        $counts['new_user_prev_month'] = isset($monthlyStats["user"]) ? $monthlyStats["user"]["new-users-prev-month-count"] : "0";
        $counts['new_user_prev_month_stroom'] = isset($monthlyStats["user"]) && isset($monthlyStats["user"]["stroom"]) ?
            $monthlyStats["user"]["stroom"]["new-users-prev-month-count"] : "0";
        $counts['new_user_curr_month'] = isset($monthlyStats["user"]) ? $monthlyStats["user"]["new-users-curr-month-count"] : "0";
        $counts['new_user_curr_month_stroom'] = isset($monthlyStats["user"]) && isset($monthlyStats["user"]["stroom"]) ?
            $monthlyStats["user"]["stroom"]["new-users-curr-month-count"] : "0";
        $counts['asset'] = isset($monthlyStats["tool"]) ? $monthlyStats["tool"]["total-count"] : "0";
        $counts['accessory'] = isset($monthlyStats["accessory"]) ? $monthlyStats["accessory"]["total-count"] : "0";
        $counts['consumable'] = \App\Models\Consumable::count();
        $counts['activity'] = isset($monthlyStats["activity"]) ? $monthlyStats["activity"]["total-count"] : "0";
        $counts['activity_active'] = isset($monthlyStats["activity"]) ? $monthlyStats["activity"]["active-count"] : "0";
        $counts['activity_overdue'] = isset($monthlyStats["activity"]) ? $monthlyStats["activity"]["overdue-count"] : "0";
        $counts['activity_co_prev_month'] = isset($monthlyStats["activity"]) ? $monthlyStats["activity"]["checkout-prev-month-count"] : "0";
        $counts['activity_co_curr_month'] = isset($monthlyStats["activity"]) ? $monthlyStats["activity"]["checkout-curr-month-count"] : "0";
        $counts['activity_ci_prev_month'] = isset($monthlyStats["activity"]) ? $monthlyStats["activity"]["checkin-prev-month-count"] : "0";
        $counts['activity_ci_curr_month'] = isset($monthlyStats["activity"]) ? $monthlyStats["activity"]["checkin-curr-month-count"] : "0";
        $counts['activity_stroom'] = isset($monthlyStats["activity"]) && isset($monthlyStats["activity"]["stroom"]) ? $monthlyStats["activity"]["stroom"]["total-count"] : "0";
        $counts['activity_co_prev_month_stroom'] = isset($monthlyStats["activity"]) && isset($monthlyStats["activity"]["stroom"]) ?
            $monthlyStats["activity"]["stroom"]["checkout-prev-month-count"] : "0";
        $counts['activity_co_curr_month_stroom'] = isset($monthlyStats["activity"]) && isset($monthlyStats["activity"]["stroom"]) ?
            $monthlyStats["activity"]["stroom"]["checkout-curr-month-count"] : "0";
        $counts['activity_ci_prev_month_stroom'] = isset($monthlyStats["activity"]) && isset($monthlyStats["activity"]["stroom"]) ?
            $monthlyStats["activity"]["stroom"]["checkin-prev-month-count"] : "0";
        $counts['activity_ci_curr_month_stroom'] = isset($monthlyStats["activity"]) && isset($monthlyStats["activity"]["stroom"]) ?
            $monthlyStats["activity"]["stroom"]["checkin-curr-month-count"] : "0";
        $counts['grand_total'] = $counts['asset'] + $counts['accessory'] + $counts['consumable'];

//        return view('dashboard')->with('asset_stats', $asset_stats)->with('counts', $counts);
        return view('klusbib::dashboard')->with('counts', $counts);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('klusbib::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('klusbib::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('klusbib::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
