<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.sales.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Non Resouce Function
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetail()
    {
        $data['salesSumary'] = DB::table(DB::raw("sales a"))
                ->select(DB::raw("a.year, a.month, a.customer, a.plan, a.actual,
                    (select b.description from months b where b.code = a.month) months_desc"))
                ->orderBy('month')
                ->get();

        $data['header'] = [];

        foreach ($data['salesSumary'] as $key => $value) {
            $data['header'][] = $value->months_desc;
            $data['plan'][] = $value->plan;
            $data['actual'][] = $value->actual;
        }

        return response()->json($data);
    }
}
