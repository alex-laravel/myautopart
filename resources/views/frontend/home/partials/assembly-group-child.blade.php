<li>
    <a href="{{ route('frontend.assembly-groups.index', $assemblyGroup['assemblyGroupNodeId']) }}">
        {{ $assemblyGroup['assemblyGroupName'] }}
    </a>
</li>

@isset($assemblyGroup['children'])
    @if (!empty($assemblyGroup['children']))
        <ul>
            @foreach($assemblyGroup['children'] as $assemblyGroup)
                @include('frontend.home.partials.assembly-group-child', $assemblyGroup)
            @endforeach
        </ul>
    @endif
@endisset
