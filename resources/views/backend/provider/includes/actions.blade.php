@if ($logged_in_user->can('admin.access.provider.edit'))
    <x-utils.edit-button :href="route('admin.provider.edit', $provider->id)" />
@endif
@if ($logged_in_user->can('admin.access.provider.delete'))
    <x-utils.delete-button :href="route('admin.provider.destroy', $provider->id)" />
@endif
