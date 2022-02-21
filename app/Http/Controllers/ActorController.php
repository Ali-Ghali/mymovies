<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $actors = Actor::where('name', 'like', '%' . request()->search . '%')
                ->limit(10)
                ->get();

            $results = [];

            $results[] = ['id' => '', 'text' => 'All Actors'];

            foreach ($actors as $actor) {

                $results[] = ['id' => $actor->id, 'text' => $actor->name];
            } //end of for each

            return json_encode($results);
        } //end of if

        return view('actors.index');
    } // end of index

    public function data()
    {
        $actors = Actor::withCount(['movies']);

        return DataTables::of($actors)
            ->addColumn('record_select', 'actors.data_table.record_select')
            ->addColumn('related_movies', 'actors.data_table.related_movies')
            ->addColumn('image', function (Actor $actor) {
                return view('actors.data_table.image', compact('actor'));
            })
            ->editColumn('created_at', function (Actor $actor) {
                return $actor->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'actors.data_table.actions')
            ->rawColumns(['record_select', 'image', 'related_movies', 'actions'])
            ->toJson();
    } // end of data
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
    public function destroy(Actor $actor)
    {
        $this->delete($actor);
        session()->flash('delete', 'تم الحذف بنجاح');
        return back();
    } // end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $actor = Actor::FindOrFail($recordId);
            $this->delete($actor);
        } //end of for each

        session()->flash('delete', 'تم الحذف بنجاح');
        return back();
    } // end of bulkDelete

    private function delete(Actor $actor)
    {
        $actor->delete();
    } // end of delete
}