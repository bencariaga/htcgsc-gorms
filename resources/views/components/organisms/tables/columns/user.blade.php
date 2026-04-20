@props(['item', 'person', 'cellStyling'])

<td class="{{ $cellStyling }}">
    <x-atoms.utility.status-badge :status="$person->type" />
</td>

<td class="{{ $cellStyling }}">
    <x-atoms.utility.status-dot :status="$item->account_status" />
</td>
