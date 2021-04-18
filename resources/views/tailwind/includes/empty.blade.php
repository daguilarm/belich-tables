<tr>
    <!-- Create the colspan base on the columns and if the checkbox is enable -->
    <td
        colspan="{{ collect($columns)->count() + ($showCheckboxes ? 1 : 0) }}"
        class="text-center p-6 bg-gradient-to-b from-white via-white to-gray-200"
    >
        <!-- Text for no results -->
        @lang('livewire-tables::strings.no_results')
    </td>
</tr>
