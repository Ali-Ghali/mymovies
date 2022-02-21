<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MovieController extends Controller
{

    public function index()
    {
        $genres = genre::all();
        $actors = Actor::limit(5)->get();


        return view('movies.index', compact('actors', 'genres'));
    } // end of index

    public function data()
    {
        $movies = Movie::whenGenreId(request()->genre_id)
            ->whenActorid(request()->actor_id)
            ->whenType(request()->type)
            ->with(['genres']);

        return DataTables::of($movies)
            ->addColumn('record_select', 'movies.data_table.record_select')
            ->addColumn('poster', function (Movie $movie) {
                return view('movies.data_table.poster', compact('movie'));
            })
            ->addColumn('genres', function (Movie $movie) {
                return view('movies.data_table.genres', compact('movie'));
            })
            ->addColumn('vote', 'movies.data_table.vote')
            ->editColumn('created_at', function (Movie $movie) {
                return $movie->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'movies.data_table.actions')
            ->rawColumns(['record_select', 'vote', 'actions'])
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


    public function show(Movie $movie)
    {
        $movie->load(['images']);

        return view('movies.show', compact('movie'));
    } // end of show

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Movie $movie)
    {
        $this->delete($movie);
        session()->flash('delete', 'تم الحذف بنجاح');
        return back();
    } // end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $movie = Movie::FindOrFail($recordId);
            $this->delete($movie);
        } //end of for each

        session()->flash('delete', 'تم الحذف بنجاح');
        return back();
    } // end of bulkDelete

    private function delete(Movie $movie)
    {
        $movie->delete();
    } // end of delete
}