<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'projects';

    protected $fillable = ['name'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function storys()
    {
        return $this->hasMany('App\Models\Story', 'project_id', 'id');
    }
    
}
