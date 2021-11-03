<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use App\Services\CacheService;
use Illuminate\Http\Request;

class DataShowController extends Controller
{
    private $cache;

    public function __construct(CacheService $cache)
    {
        $this->cache = $cache;
    }

    public function index()
    {
        /*ini_set('memory_limit', '-1');
        ini_set("max_execution_time", "-1");*/

        // Another way
        // select * from user_infos where date_part('month', dob) = '4';

        $yob = request('yob', null);
        $mob = request('mob', null);
        $page = request('page', 1);
        if ($page <= 0)
            $page = 1;
        $perPage = request('perPage', 20);

        if (!request()->has('yob') && !request()->has('mob')) {
            $data = [];
            $totalData = 0;
            return view('pages.index', compact('data', 'page', 'totalData', 'yob', 'mob'. 'perPage'));
        }

        if ($data = $this->cache->getUserInfoData(request('yob', null), request('mob', null))) {
            $totalData = count($data);
            $data = array_slice($data, (($page - 1) * $perPage), $perPage);
            return view('pages.index', compact('data', 'page', 'totalData', 'yob', 'mob', 'perPage'));
        }

        $query = UserInfo::query();
        $query->when(request('yob'), function ($query, $yob) {
            $query->where('yob', $yob);
        });
        $query->when(request('mob'), function ($query, $mob) {
            $query->where('mob', $mob);
        });

        $data = $query->get()->toArray();
        $this->cache->setUserInfoData($data, request('yob', null), request('mob', null), config('settings.ttl.cache'));

        $totalData = count($data);
        $data = array_slice($data, (($page - 1) * $perPage), $perPage);

        return view('pages.index', compact('data', 'page', 'totalData', 'yob', 'mob', 'perPage'));
    }
}
