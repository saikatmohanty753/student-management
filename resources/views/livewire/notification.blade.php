<div>
    <p>{{ $counter }}</p>
    <div class="form-group">
    <input type="number" class="form-control" wire:model="size">
    </div>
    <button wire:click="increment" class="btn btn-info"> + </button> | <button wire:click="decrement" class="btn btn-info"> - </button>
</div>
