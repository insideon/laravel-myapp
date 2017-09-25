@if ($tags->count())
    <ul>
        @foreach ($tags as $tag)
        <li>
            <a href="{{ route('tags.articles.index', $tag->slug) }}">{{ $tag->{$currentLocale} }}</a>
        </li>
        @endforeach
    </ul>
@endif
