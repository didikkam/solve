@if ($logged_in_user->can('admin.access.category.edit'))
    <x-utils.edit-button :href="route('admin.category.edit', $category->id)" />
@endif
@if ($logged_in_user->can('admin.access.category.delete'))
    <x-utils.delete-button :href="route('admin.category.destroy', $category->id)" />
@endif
