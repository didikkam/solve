@if ($logged_in_user->can('admin.access.event.edit'))
    <x-utils.edit-button :href="route('admin.event.edit', $event->id)" />
@endif
@if ($logged_in_user->can('admin.access.event.delete'))
    <x-utils.delete-button :href="route('admin.event.destroy', $event->id)" />
@endif
