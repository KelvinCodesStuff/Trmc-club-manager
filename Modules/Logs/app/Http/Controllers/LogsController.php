<?php

namespace Modules\Logs\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laravelLogs = array_reverse(file(storage_path('logs/laravel.log')));
        $userActivityLogs = array_reverse(file(storage_path('logs/user_activity.log')));
        $memberActivityLogs = array_reverse(file(storage_path('logs/member_activity.log')));
        $accessLogs = array_reverse(file(storage_path('logs/access.log')));

        return view('logs::pages.index', compact('laravelLogs', 'userActivityLogs','memberActivityLogs', 'accessLogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('logs::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('logs::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('logs::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
