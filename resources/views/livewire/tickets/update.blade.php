<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="name"></label>
                <input wire:model="name" type="text" class="form-control" id="name" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="description"></label>
                <input wire:model="description" type="text" class="form-control" id="description" placeholder="Description">@error('description') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                        <label>Status</label>
                        <select wire:model="status" class="form-control" name="status">
                            <option selected>Select Status</option>
                            <option value="Activo">Activo</option>
                            <option value="En Proceso"> En Proceso</option>
                            <option value="Finalizado">Finalizado</option>
                        </select>
                        @error('status') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <select wire:model="story_id"  name="story_id" class="form-control custom-select">
                            <option value="">Select Stories</option>
                            @foreach($storys as $story)}
                                <option value="{{ $story->id }}">{{ $story->name }}</option>
                            @endforeach
                        </select>
                        @error('story_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
       </div>
    </div>
</div>