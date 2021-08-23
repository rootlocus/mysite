<div>
    <input wire:model="name" type="text">
    <input wire:model="loud" type="checkbox"> LOUD

    <select wire:model="greeting" multiple>
        <option>HELLO</option>
        <option>GOODBYE</option>
        <option>CHAOIZ</option>
    </select>
    {{ implode(', ', $greeting) }} {{ $name }} @if ($loud) ! @endif

    <!-- <button wire:click="resetName($event.target.innerText)">Reset Name</button> -->
    <!-- <form action="#" wire:submit.prevent="resetName('Bingo')"> -->
    <form action="#" wire:submit.prevent="$set('name', 'BINGO')">
        <button>Reset Name</button>
    </form>
    {{ $hydrated }}
    {{ $updated }}
</div>
