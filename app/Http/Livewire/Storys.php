<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Story;
use App\Models\Project;
use App\Models\Ticket;

class Storys extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $description, $project_id, $projects_name;
    public $updateMode = false;
    //public $projects =[];

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.Storys.view', [
            'storys' => Story::select('storys.id','storys.name','storys.description','projects.name As projects_name')
                        ->join('projects', 'projects.id', '=', 'storys.project_id')
						->orWhere('storys.name', 'LIKE', $keyWord)
						->orWhere('storys.description', 'LIKE', $keyWord)
						->orWhere('storys.project_id', 'LIKE', $keyWord)
						->paginate(10),
            'projects' => Project::all()    
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->name = null;
		$this->description = null;
		$this->project_id = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
		'description' => 'required',
        ]);

        Story::create([ 
			'name' => $this-> name,
			'description' => $this-> description,
			'project_id' => $this-> project_id
        ]);

        $newStory = Story::select('name','id')
                ->where('name', $this-> name)
                ->where('description', $this-> description)
                ->where('project_id', $this-> project_id)
                ->first();
        $idStory=$newStory->id;

        $descriptionTicket="Create Ticket of ".$this-> name;
        $nameTicket="Create_Ticket_".$this-> name;

        Ticket::create([ 
			'name' => $nameTicket,
			'description' => $descriptionTicket,
			'status' => "Activo",
			'story_id' => $idStory
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Story Successfully created.');
    }

    public function edit($id)
    {
        $record = Story::findOrFail($id);

        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->description = $record-> description;
		$this->project_id = $record-> project_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'description' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Story::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'description' => $this-> description,
			'project_id' => $this-> project_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Story Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Story::where('id', $id);
            $record->delete();
        }
    }
}
