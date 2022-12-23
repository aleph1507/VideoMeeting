<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Stats;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class StatsController extends Controller
{

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return the server IP if the client IP is not found using this method.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return false|string
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'bid' => 'required|exists:banners,id',
            'action' => [
                'required',
                Rule::in(Stats::ACTIONS),
            ],
        ]);

        $date = Carbon::now()->format('Y-m-d');
        $banner = Banner::find($request->get('bid'));
        $stats = $banner->stats()->where('date', $date)->firstOrCreate();
        $stats->date = $date;
        $request->get('action') === Stats::ACTION_SHOW ? $stats->total_views++ : $stats->total_clicks++;
        $stats->save();

        return json_encode([
            'stats' => 'stored',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stats  $stats
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Stats $stats)
    {
        $date = $stats->date;
        $stats->delete();
        return redirect()->back()->with('success', 'Statistics for ' . $date . ' deleted.');
    }
}
