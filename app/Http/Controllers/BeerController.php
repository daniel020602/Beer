<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeerRequest;
use App\Models\Beer;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Imagick\Decoder\JpegDecoder;
use Intervention\Image\Imagick\Decoder\PngDecoder;
use Intervention\Image\Imagick\Decoder\GifDecoder;

class BeerController extends Controller
{
    
    public function index(Request $request) {
        $results = Beer::join('types', 'beers.type', '=', 'types.id')
            ->select('beers.id as beer_id', 'beers.name', 'types.title', 'beers.alc_content', 'beers.point')
            ->with('type')
            ->search($request)
            ->get();
        //dd($results);
        return view('index', [
            'beers' => $results,
        ]);
    
    }
    public function create(){
        
        return view('edit',['types'=>Type::query()->get(),]);
    }


    public function store(BeerRequest $request)
    {
        $validated = $request->validated();
    
        // Handle image upload
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images', $imageName); // Store image
            //dd($path);
            
    
            // Update image URL
        }
    
        Beer::create($validated);
    
        return redirect()->route('beers.index')->with('success', 'Sikeres mentés');
    }
    

    public function edit(Beer $beer){
        return view('edit',['beer'=>$beer,'types' => Type::query()->get(),]);
    }
    public function update(BeerRequest $request, Beer $beer)
    {
        $validated = $request->validated();
    
        if ($request->hasFile('image_url')) {
            // Delete old image if exists
            if ($beer->image_url) {
                Storage::disk('images')->delete($beer->image_url);
            }
    
            // Store new image
            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, ['disk' => 'public']); // Store image
            $validated['image_url'] = '/storage/' . $imagePath; // Update image URL
    
            
        }
    
        // Update beer
        $beer->update($validated);
    
        return redirect()->route('beers.index')->with('success', 'Sikeres mentés');
    }
    

    public function destroy(Beer $beer){
        $beer->delete();
        return redirect()->route('beers.index')->with('success','sikeres törlés');
    }
    
}
