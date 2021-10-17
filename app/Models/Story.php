<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'storys';

    protected $fillable = ['name','description','project_id','projects_name'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket', 'story_id', 'id');
    }

    public function projectName (){
        return $this->project->name;
    }
    
}
