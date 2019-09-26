<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Series;
use App\Entry;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Series::with('purchase_order', 'module')->get();

        return view('series.index', [
            'series' => $series,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        return view('series.create');
    }

    public function create_entries (Request $request, Series $series) {
        $data = [
            'series' => $series,
            'accounts' => Account::all()->toJson(),
            'sites' => Site::all()->toJson(),
            'series_show_url' => route('series.show', $series),
        ];

        return view('series.entries', $data);
    }

    public function store_entries (Request $request, Series $series) {
        // validation
        $validator = Validator::make($request->all(), [
            '*.account.id' => 'required|exists:accounts,id',
            '*.site' => 'required|exists:sites,id',
            '*.amount' => 'required|numeric|min:0',
            '*.description' => 'required|string|max:200',
            '*.type' => 'required|in:debit,credit',
        ], [
            '*.account.id.required' => 'Account is not set',
            '*.site.required' => 'Please select Site',
        ])->validate(); // automatic error response

        // start dabatase transaction
        DB::beginTransaction();

        $new = function ($entry_data) use ($series) {
            // prepare data
            $entry_data['site_id'] = $entry_data['site'];
            $entry_data['series_id'] = $series->id;
            $entry_data['account_id'] = $entry_data['account']['id'];
            // create instance
            $entry = new Entry($entry_data);
            // save instance
            $entry->save();
            // return to list
            return $entry;
        };

        // create new Entries
        $entries = array_map($new, $request->all());

        // persist dabatase changes
        DB::commit();

        return $entries;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $series = new Series($request->all());
        $series->save();

        return redirect()->route('series.show', $series);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Series $series)
    {
        // check if series has attached entries
            // if true, display details
            // else, redirect to create

        $series->load(
            'entries.site', 'entries.account', 'purchase_order', 'module'
        );

        return view('series.show', [
            'series' => $series,
        ]);
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
}
