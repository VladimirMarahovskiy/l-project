<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Intervention\Image\Facades\Image;

class Category extends Model
{
    use CrudTrait;


    const IMAGES_DIR = '/uploads/';
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'categories';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];

    // protected $hidden = [];
    // protected $dates = [];

    protected $fillable = [
              'title',
        'content',
        'slug',
        'image',
    ];
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function setImageAttribute($value)
    {
        if (!is_null($value)) {
            $image = $value;
            // var_dump($image);die();
            $file_name = md5(time() . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $image = Image::make($image)->save(public_path( self::IMAGES_DIR . $file_name));

            $this->attributes['image'] = $file_name;
        }
        else {
            $this->attributes['image'] = '';
        }
    }

    public function getImageAttribute()
    {

        return !empty($this->attributes['image']) ? self::IMAGES_DIR . $this->attributes['image'] : '';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
