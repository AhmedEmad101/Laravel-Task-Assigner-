<!DOCTYPE html>
<html>
<head>
    <title>Teams</title>
</head>
<body>
    <h1>Your Teams</h1>

    @foreach ($PfTeams as $teamName => $teams)
        <div>
            <h3>Team Name: {{ $teamName }}</h3>
            @php
                $leaderDisplayed = false;  // Flag to check if leader is displayed
            @endphp
            @foreach ($teams as $team)
                @if (!$leaderDisplayed)
                    <p><strong>Leader ID:</strong> {{ $team->leader_Id }}</p>
                    <p><strong>Created At:</strong> {{ $team->created_at ?? 'Not Set' }}</p>
                    <p><strong>Updated At:</strong> {{ $team->updated_at ?? 'Not Set' }}</p>
                    @php
                        $leaderDisplayed = true;  // Mark leader as displayed
                    @endphp
                @endif

                <strong>Members:</strong>
                <ul>
                    <li>Member ID: {{ $team->member_id }}</li>
                </ul>
            @endforeach
        </div>
    @endforeach
</body>
</html>
