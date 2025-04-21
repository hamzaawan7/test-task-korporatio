<x-filament-panels::page>
    <div class="w-full mx-auto">
        <form wire:submit.prevent="save" class="space-y-6">
                {{ $this->form }}
                <x-filament-panels::form.actions :actions="$this->getFormActions()" />
        </form>
    </div>
</x-filament-panels::page>
