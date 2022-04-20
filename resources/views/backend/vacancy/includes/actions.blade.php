@if ($logged_in_user->can('admin.access.vacancy.edit'))
    <x-utils.edit-button :href="route('admin.vacancy.edit', $vacancy->id)" />
@endif
@if ($logged_in_user->can('admin.access.vacancy.delete'))
    <x-utils.delete-button :href="route('admin.vacancy.destroy', $vacancy->id)" />
@endif
