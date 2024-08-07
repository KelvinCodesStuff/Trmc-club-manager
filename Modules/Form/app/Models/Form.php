<?php

namespace Modules\Form\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Form\Database\Factories\FormFactory;
use Modules\Members\Models\Member;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Form\Models\SubmittedModel;

class Form extends Model
{
    use HasFactory;
    protected $table = 'form';
    
    /**
     * The attributes that are mass assignable.
     * 
     * @var string name
     * @var datetime date_time
     */
    protected $fillable = [
        'name',
        'date_time',
    ];

    /**
     * Form to member relationship
     * 
     * @return BelongsToMany
     */
    public function member(): BelongsToMany
    {
        return $this->BelongsToMany(Member::class);
    }

    /**
     * Form to submitted models relationship
     * 
     * @return BelongsToMany
     */
    public function submittedModels(): BelongsToMany
    {
        return $this->belongsToMany(SubmittedModel::class, 'form_model');
    }
}
