<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Network Monitor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--<meta http-equiv="refresh" content="{{ env('AUTO_REFRESH_SECONDS', 60) }}">-->

    <style>
        @font-face {
            font-family: 'GraffitiFont';
            /* You must download a free graffiti font (e.g., 'GraffitiFont.woff2') 
               and place it in public/fonts/ for a real application */
            src: url('/fonts/qb.ttf') format('woff2');
            font-weight: normal;
            font-style: normal;
        }
        .graffiti-text {
            font-family: 'GraffitiFont', cursive;
            font-size: 2rem;
            color: #333; /* Example color */
        }
        .reviewed-row {
            background-color: #d1e7dd; /* Bootstrap success color variant (green) */
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <h1 class="mb-4">Inbound Network Connections</h1>

        <div class="card mb-4">
            <div class="card-header">Display Options</div>
            <div class="card-body">
                <form action="{{ route('preferences.update') }}" method="POST">
                    @csrf
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="omit_reviewed_rows" id="omitReviewed" {{ $fieldPreferences->get('omit_reviewed_rows') ? 'checked' : '' }}>
                        <label class="form-check-label" for="omitReviewed">
                            Omit Reviewed Rows
                        </label>
                    </div>
                    <div class="mt-3">
                         <button type="submit" class="btn btn-sm btn-primary">Apply Preferences</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class="table-dark sticky-top">
                    <tr>
                        <th>Hostname</th>
                        <th>IP Address</th>
                        <th>Whois</th>
                        <th>Process</th>
                        <th>Location</th>
                        <th>Comments</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                        <tr class="{{ $request->reviewed ? 'reviewed-row' : '' }}">
                            <td>{{ $request->server_hostname }}</td>
                            <td><a href="https://ipinfo.io/{{ $request->ip_address }}" target="_blank">{{ $request->ip_address }}</a></td>
                            <td>{{ $request->whois }}</td>
                            <td>{{ $request->process }}</td>
                            <td>{{ $request->location }}</td>
                            <td>
                                <form action="{{ route('request.update.comment', $request->ip_address) }}" method="POST" class="d-flex">
                                    @csrf
                                    <input type="text" name="comments" value="{{ $request->comments }}" class="form-control form-control-sm me-2" placeholder="Add comment...">
                                    <button type="submit" class="btn btn-sm btn-success">Save</button>
                                </form>
                            </td>
                            <td>
                                <span class="badge {{ $request->reviewed ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $request->reviewed ? 'Reviewed' : 'Pending Review' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <footer class="text-center py-3 border-top mt-5">
        <p class="graffiti-text">DreamLoud</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>