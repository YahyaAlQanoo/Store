<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'parent_id', 'name', 'slug', 'description', 'image', 'status'
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id','id')
            ->withDefault([
                'name' => '------'
            ]);
    }

    public function childrens()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public static function rules ($id = 0)
    {
        return[
            'name' => ['required','min:3','max:100',
                        Rule::unique('categories','name')->ignore($id),
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
                            ->dimensions(Rule::dimensions()->maxWidth(10000)->maxHeight(10000))],
            'parent_id' => ['nullable','int','exists:categories,id'],
            'description' => ['required'],
            'status' => ['in:active,inactive','required']
        ];

    }

    public function scopeActive(Builder $builder) {
        $builder->where('status','=','active');
    }
    public function scopeStatus(Builder $builder, $status) {
        $builder->where('status','=',$status);
    }
    public function scopeFilter(Builder $builder, $filter) {
        if($filter['name'] ?? false ) {
            $builder->where('categories.name','LIKE',"%{$filter['name']}%");
        }
        if($filter['status'] ?? false) {
            $builder->where('categories.status','=',$filter['status']);
        }

        // $builder->when($filter['name'] ?? false ,function($builder,$value) {
        //     $builder->where('name','LIKE',"%{$value}%");
        // });
        // $builder->when($filter['status'] ?? false ,function($builder,$value) {
        //     $builder->where('status','=', $value);
        // });

    }


}
