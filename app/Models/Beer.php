<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Beer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'alc_content', 'point', 'type','image_url'];

    
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    
    public function scopeSearch(Builder $query, Request $request )
    {
        return $query->when($request->name, function (Builder $query ,string $name){
            $query->where(function (Builder $query) use ($name) {
                return $query->where('name', 'LIKE','%'.$name.'%')->when(str_contains($name, ' '), 
                function(Builder $query) use ($name) {
                    foreach (explode(',', $name) as $search){
                        $query->orWhere('name','LIKE','%'.$search.'%');
                    }
                }
            );
            });
        }
    );
    }
}
