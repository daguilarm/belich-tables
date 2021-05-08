<td class="p-1 xl:p-3">
    <input
        type="checkbox"
        wire:model="checkboxValues"
        value="{{ $model->id }}"
        class="shadow opacity-75 __checkboxes"
        dusk="table-index-checkbox-{{ $model->id }}"
    >
</td>
