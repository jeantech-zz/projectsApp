<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'tickets';

    protected $fillable = ['name','description','status','story_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function story()
    {
        return $this->hasOne('App\Models\Story', 'id', 'story_id');
    }
    
}
