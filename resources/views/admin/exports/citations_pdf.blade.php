<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Citations PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #000; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; font-size: 12px; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Citations List</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Full Name</th>
                <th>Unit</th>
                <th>Group</th>
                <th>Designation</th>
                <th>Handle</th>
                <th>Phone</th>
                <th>Citation</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citations as $citation)
            <tr>
                <td>{{ $citation->title }}</td>
                <td>{{ $citation->name }}</td>
                <td>{{ $citation->unit }}</td>
                <td>{{ $citation->groups }}</td>
                <td>{{ $citation->designation }}</td>
                <td>{{ $citation->handle }}</td>
                <td>{{ $citation->phone }}</td>
                <td>{{ $citation->citation }}</td>
                <td>{{ $citation->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
