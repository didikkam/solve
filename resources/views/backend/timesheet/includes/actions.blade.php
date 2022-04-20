@if ($logged_in_user->can('admin.access.media_news.edit'))
    <x-utils.edit-button :href="route('admin.media_news.edit', $media_news->id)" />
@endif
@if ($logged_in_user->can('admin.access.media_news.delete'))
    <x-utils.delete-button :href="route('admin.media_news.destroy', $media_news->id)" />
@endif
