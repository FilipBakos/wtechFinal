<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Genre;
use App\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ItemController extends Controller
{
    public function show(Request $request)
    {
        $item = Item::find( strtoupper($request->segment(2)));

        try {
            $info = file_get_contents("http://ws.audioscrobbler.com/2.0/?method=album.getinfo&artist=".$item->artist_name."&album=".$item->album_name."&api_key=d52180fcfa4cc62e0abcb8b9046bee63&format=json");
            $content = json_decode($info, true);
            $tracks = [];
            foreach ($content as $c){
                $tracksWeb = $c['tracks']['track'];
                foreach ($tracksWeb as $track){
                    array_push($tracks,$track['name']);
                }
            }
        } catch (Exception $e) {
            $tracks = ['Chybaju data'];
        }

        return view('layouts/detail')
            ->with('item', $item)
            ->with('tracks', $tracks);
    }

    public function showAll()
    {
        $items = Item::paginate(12);
       // dd($items);
        return view('layouts/home')
            ->with('items', $items);

    }


    public function showCD()
    {
        $items = Item::where('type','CD')->paginate(12);
        // dd($items);
        return view('layouts/category')
            ->with('items', $items)
            ->with('type','CD')
            ->with('genres', $this->getGenres())
            ->with('artists', $this->getArtists());
    }

    public function showLP()
    {
        $items = Item::where('type','LP')->paginate(12);
        // dd($items);
        return view('layouts/category')
            ->with('items', $items)
            ->with('type','LP')
            ->with('genres', $this->getGenres())
            ->with('artists', $this->getArtists());
    }

    public function showDVD()
    {
        $items = Item::where('type','DVD')->paginate(12);
        // dd($items);
        return view('layouts/category')
            ->with('items', $items)
            ->with('type','DVD')
            ->with('genres', $this->getGenres())
            ->with('artists', $this->getArtists());
    }

    public function filter(Request $request, Item $item)
    {
        $item = $item->newQuery();

        /*Filtruje podla tagov, je to pivot tabulka preto to musi byt takto*/
        if($request->has('tag'))
            $item->whereHas('genres', function ($query)  use ($request) {
                $query->whereIn('name', $request->input('tag'));
            });

        $item->where('type', $request->segment(2));

        if($request->has('artist'))
            $item->whereIn('artist_name', $request->input('artist'));

        if($request->has('year_from'))
            $item->where('year', '>=', $request->input('year_from'));

        if($request->has('year_to'))
            $item->where('year', '<=', $request->input('year_to'));

        if($request->has('price_from'))
            $item->where('price', '>=', $request->input('price_from'));

        if($request->has('price_to'))
            $item->where('price', '<=', $request->input('price_to'));

        $filtered = $item->paginate(12);

        return view('layouts/category')
            ->with('items', $filtered)
            ->with('type',$request->segment(2))
            ->with('genres', $this->getGenres())
            ->with('artists', $this->getArtists());;
    }


    public function getGenres()
    {
        $genres = Genre::all();
        return $genres;
    }

    public function getArtists()
    {
        $artists = Artist::all();
        return $artists;
    }

    public function list($page) {
        $rowsPerPage = 30;

        $sortBy = request('sortBy', 'artist_name');
        $descendingBool = request('descending', 'false');
        $descending = $descendingBool === 'true' ? 'desc' : 'asc';


        if ($rowsPerPage == 0) {
            $items = DB::table('items')
                ->orderBy($sortBy, $descending)
                ->get();
        } else {
            $offset = ($page - 1) * $rowsPerPage;

            $items = DB::table('items')
                ->orderBy($sortBy, $descending)
                ->offset($offset)
                ->limit($rowsPerPage)
                ->get();
        }

        $rowsNumber = DB::table('items')->count();

        return response()->json(['rows' => $items, 'rowsNumber' => $rowsNumber]);
    }

    public function destroy( $id)
    {
        try {
            Item::find($id)->delete();
        } catch (Exception $e) {
            return response()->json(['status'=>'failed','msg' => $e->getMessage()]);
        }
        return response()->json(['status'=>'success','msg' => "Polozka bola vymazana"]);
    }

    public function edit($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        // validations and error handling is up to you!!! ;)
        $validation = $request->validate([
            'artistName' => 'required|max:250',
            'albumName' => 'required|max:250',
            'price' => 'required|numeric',
            'type' => 'required',
            'number' => 'required|numeric|min:0',
        ],[
            'artistName.required' => 'Zadaj meno autora!',
            'albumName.required' => 'Zadaj meno albumu!',
            'price.required' => 'Zadaj cenu!',
            'type.required' => 'Nevybral si typ!',
            'price.numeric' => 'Cena musi cislo !',
            'number.numeric' => 'Pocet poloziek (number) musi cislo !',
        ]);
        try {
            $item = Item::find($id);
            $item->artist_name = $validation['artistName'];
            $item->album_name =  $validation['albumName'];
            $item->price = $validation['price'];
            $item->type =  $validation['type'];
            $item->number = $validation['number'];
            $item->save();
        } catch (Exception $e){
            return response()->json(['status'=>'negative','msg' => $e->getMessage()]);
        }
        return response()->json(['status'=>'positive','msg' => 'Produkt bol updatovany']);
    }

    public function storeImage(Request $request)
    {
        //$image = $request->get('image');
        $validation = $request->validate([
            'file' => 'image|mimes:jpeg,png'
        ]);
        try {
            try {
                $file = $validation['file'];
            } catch (\Error $error) {
                return $error;
            }
            $path = '.' . '\public\img\\' .
            $fileName = $file->getClientOriginalName();
            $file->storeAs('.\public\img\\', $fileName);
        } catch (Exception $e) {
            return response()->json(['status'=>'negative','msg' => $e->getMessage()]);
        }

        return response()->json(['status'=>'positive','msg' => 'Obrazok bol uploadovany']);
    }

    public function store(Request $request)
    {
        // validations and error handling is up to you!!! ;)
        /*
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required',
        ]);
        */
        $validation = $request->validate([
            'artistName' => 'required|max:250',
            'albumName' => 'required|max:250',
            'price' => 'required|numeric',
            'type' => 'required',
            'number' => 'required|numeric|min:0',
            'year' => 'required',
            'img_link' => 'required',
        ],[
            'artistName.required' => 'Zadaj meno autora!',
            'albumName.required' => 'Zadaj meno albumu!',
            'price.required' => 'Zadaj cenu!',
            'type.required' => 'Nevybral si typ!',
            'year.required' => 'Neurcil si rok!',
            'price.numeric' => 'Cena musi cislo !',
            'number.numeric' => 'Pocet poloziek (number) musi cislo !',
        ]);

    try {
//        $item = Item::create(['artist_name' => $request->artistName,
//            'album_name' => $request->albumName,
//            'price' => (float)$request->price,
//            'type' => $request->type,
//            'img_link' => 'img/linkin-park-hybrid-theory.jpg',
//            'number' => (int)$request->number,
//            'year' => (int)$request->year
//        ]);
        $item = new Item;
        try {
            $item->artist_name = $validation['artistName'];
            $item->album_name = $validation['albumName'];
            $item->price = $validation['price'];
            $item->type = $validation['type'];
            $item->number = $validation['number'];
            $item->year = $validation['year'];
            $item->img_link = $validation['img_link'];
        } catch (\Error $error) {
            return $error;
        }

        $item->save();
        if($request->multipleSelect) {
            $genres = $request->multipleSelect;
            foreach ($genres as $genre){
                $genreDB = Genre::find($genre);
                $item->genres()->save($genreDB);
            }
        }
    } catch (Exception $e) {
        //return "V neporiadku";
        return response()->json(['status'=>'succes','msg' => $e]);
    }
    return response()->json(['id' => $item->id]);
    }

}
