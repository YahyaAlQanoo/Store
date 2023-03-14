<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable =[
        'store_id', 'category_id', 'name', 'slug', 'description', 'image', 'price', 'compare_price', 'options', 'rating', 'featured', 'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id')
        ->withDefault([
            'name' => '---'
        ]);
    }

    public function store()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,     // Related Model
            'product_tag',  // Pivot table name
            'product_id',   // FK in pivot table for the current model
            'tag_id',       // FK in pivot table for the related model
            'id',           // PK current model
            'id'            // PK related model
        );
    }

    public function scopeActive(Builder $builder) {
        $builder->where('status','=','active');
    }









    // public static function booted()
    // {
    //     static::addGlobalScope('store', function(Builder $builder) {
    //         $user = Auth::user();
    //         if($user->store_id){
    //             $builder->where('store_id','=', $user->store_id);
    //         }
    //     });
    // }
    public static function booted()
    {
        static::addGlobalScope('store', new StoreScope());
    }


    public static function rules ($id = 0)
    {
        return[
            'name' => ['required','min:3','max:100',
                        Rule::unique('products','name')->ignore($id),
                        // function ($attribute, $value, $fail) {
                        //     if( strtolower($value)  == 'laravel') {
                        //         $fail('بنفعش تحط هادي الكلمة');
                        //     }
                        // }
                        // new Filter(['laravel','php','html','css']),
                        'Filter:laravel,php,html'

                    ],
            'image' => [File::image()
                            ->min(20)
                            ->max(1024 * 1024)
                            ->dimensions(Rule::dimensions()->maxWidth(1000)->maxHeight(1000))],
            'category_id' => ['nullable','int','exists:categories,id'],
            'store_id' => ['required','int','exists:stores,id'],
            'description' => ['required'],
            'price' => ['required'],
            'compare_price' => ['required'],
            'featured' => ['nullable','int'],
            'status' => ['in:active,inactive','required']
        ];

    }



        // Accessors
    // $product->image_url
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://www.incathlab.com/images/products/default_product.png';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    public function getSalePercentAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }
        return round(100 - (100 * $this->price / $this->compare_price), 1);
    }

    public function getNewAttribute()
    {
        if ($this->created_at  > Carbon::yesterday()) {
            return Carbon::yesterday() ;
        }
        return 0;
    }

}
