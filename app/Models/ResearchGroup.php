<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ResearchGroup
 *
 * @property $id
 * @property $created_at
 * @property $updated_at
 * @property $research_group
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ResearchGroup extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['research_group'];


}
