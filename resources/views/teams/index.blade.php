<ul>
    @foreach ($teams as $team)
        <li>
            {{ $team->name }}
            <ul>
                @foreach ($team->users as $user)
                    {{ $user->name }}:
                        position {{ $team->pivot->position }},
                        started at {{ $team->pivot->created_at }}
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>
