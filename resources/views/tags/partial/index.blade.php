<p class="lead">
    <i class="fa fa-tags"></i>
    태그
</p>

<ul class="list-unstyled">
    @foreach($allTags as $tag)
    <li {!! str_contains(request()->path(), $tag->slug) ? 'class="active"' : '' !!}>
        <a href="{{ route('tags.articles.index', $tag->slug) }}">
            {{ $tag->{$currentLocale} }}
            @if ($count = $tag->articles->count())
            <span class="badge badge-default">{{ $count }}</span>
            @endif
        </a>
    </li>
    @endforeach
</ul>
