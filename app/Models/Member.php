<?php

namespace App\Models;

use App\Models\Kernel\HasModifiersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasModifiersTrait;

    protected $fillable = [
        'name',
        'lastname',
        'fullname',
        'birthdate',
        'phone_number',
        'mobile_number',
        'email',
        'position',
        'category',
        'scope',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    public static $categories_descriptions = [
        'administrative' => 'Administrative description',
        'operative' => 'Operative description',
    ];

    public static $scopes_descriptions = [
        'external' => 'External description',
        'internal' => 'Internal description',
    ];

    public function getBirthdateInputAttribute()
    {
        return $this->birthdate ? $this->birthdate->format('Y-m-d') : null;
    }

    public function getBirthdateHumanAttribute()
    {
        return $this->birthdate ? $this->birthdate->format('d M, Y') : null;
    }

    public function getContactCollectionAttribute()
    {
        return collect([
            'phone' => $this->phone_number,
            'mobile' => $this->mobile_number,
            'email' => $this->email,
        ]);
    }

    public function isActive()
    {
        return (bool) $this->is_active;
    }

    public function isHappyBirthday()
    {
        return $this->birthdate->isBirthday();
    }

    public function scopeOperative($query)
    {
        return $query->where('category', 'operative');
    }

    

    public static function getScopes()
    {
        return array_keys(self::$scopes_descriptions);
    }

    public static function getScopesDescriptions()
    {
        return self::$scopes_descriptions;
    }

    public static function getCategories()
    {
        return array_keys(self::$categories_descriptions);
    }

    public static function getCategoriesDescriptions()
    {
        return self::$categories_descriptions;
    }
}
