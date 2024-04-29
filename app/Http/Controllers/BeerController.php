<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeerRequest;
use App\Models\Beer;
use App\Models\Type;
use Illuminate\Http\Request;

class BeerController extends Controller
{
    public function index() {
        $results = Beer::join('types', 'beers.type', '=', 'types.id')
            ->with('type') // Eager load the 'type' relationship
            ->get();
        //dd($results);
        return view('index', [
            'beers' => $results,
        ]);
    }
    
    
    
    public function create(){
        
        return view('edit',['types'=>Type::query()->get(),]);
    }
    public function store(BeerRequest $request){
        Beer::query()->create($request->validated());
        return redirect()->route('beers.index')->with('success','sikeres mentés');
    }
    public function edit(Beer $beer){
        return view('edit',['beer'=>$beer,'types' => Type::query()->get(),]);
    }
    public function update(BeerRequest $request,Beer $beer){
        $beer->update($request->validated());
        return redirect()->route('beers.index')->with('success','sikeres mentés');
    }
    public function delete(Beer $beer){
        $beer->delete();
        return redirect()->route('beers.index')->with('success','sikeres törlés');
    }
    
}
