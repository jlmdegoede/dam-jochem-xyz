<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'category', // This is based on your requirement. Adjust if this is meant to be 'parent_id' or similar for hierarchical categories.
    ];

    /**
     * Get the digital asset associated with the category.
     */
    public function digitalAsset()
    {
        return $this->hasOne(DigitalAsset::class);
    }
}
