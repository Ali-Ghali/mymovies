<?php

namespace App\Http\Controllers;

use App\Models\genre;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GenreController extends Controller
{

    public function index()
    {

        return view('genres.index');
    }

    public function data()
    {
        $genres = genre::withCount(['movies']);

        return DataTables::of($genres)
            ->addColumn('record_select', 'genres.data_table.record_select')
            ->addColumn('related_movies', 'genres.data_table.related_movies')
            ->editColumn('created_at', function (genre $genre) {
                return $genre->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'genres.data_table.actions')
            ->rawColumns(['record_select', 'related_movies',  'actions'])
            ->toJson();
    } // end of data

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(genre $genre)
    {
        $this->delete($genre);
        session()->flash('delete', 'تم الحذف بنجاح');
        return back();
    } // end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $genre = genre::FindOrFail($recordId);
            $this->delete($genre);
        } //end of for each

        session()->flash('delete', 'تم الحذف بنجاح');
        return back();
    } // end of bulkDelete

    private function delete(genre $genre)
    {
        $genre->delete();
    } // end of delete
}