<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ticket;
use App\Models\Story;

class Tickets extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $description, $status, $story_id;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.tickets.view', [
            'tickets' => Ticket::select('tickets.*', 'storys.name As storys_name')
                        ->join('storys', 'storys.id', '=', 'tickets.story_id')
                        ->latest()
						->orWhere('tickets.name', 'LIKE', $keyWord)
						->orWhere('tickets.description', 'LIKE', $keyWord)
						->orWhere('tickets.status', 'LIKE', $keyWord)
						->orWhere('tickets.story_id', 'LIKE', $keyWord)
						->paginate(10),
            'storys' => Story::all()                       
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
		$this->status = null;
		$this->story_id = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
		'description' => 'required',
		'status' => 'required',
        ]);

        Ticket::create([ 
			'name' => $this-> name,
			'description' => $this-> description,
			'status' => $this-> status,
			'story_id' => $this-> story_id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Ticket Successfully created.');
    }

    public function edit($id)
    {
        $record = Ticket::findOrFail($id);

        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->description = $record-> description;
		$this->status = $record-> status;
		$this->story_id = $record-> story_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'description' => 'required',
		'status' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Ticket::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'description' => $this-> description,
			'status' => $this-> status,
			'story_id' => $this-> story_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Ticket Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Ticket::where('id', $id);
            $record->delete();
        }
    }
}
