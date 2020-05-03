<?php

namespace Modules\Klusbib\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
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
        $counts['asset'] = isset($monthlyStats["tool"]) ? $monthlyStats["tool"]["total-count"] : "0";
        $counts['accessory'] = isset($monthlyStats["accessory"]) ? $monthlyStats["accessory"]["total-count"] : "0";
        $counts['consumable'] = \App\Models\Consumable::count();
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
