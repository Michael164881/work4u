<!DOCTYPE html>
<html>
<head>
    <title>Statistics Export</title>
</head>
<body>
    <h3>Statistics</h3>
    <table>
        <tr>
            <th>Type</th>
            <th>Count</th>
        </tr>
        <tr>
            <td>Customers</td>
            <td>{{ $customerCount }}</td>
        </tr>
        <tr>
            <td>Freelancers</td>
            <td>{{ $freelancerCount }}</td>
        </tr>
        <tr>
            <td>Pending Bookings</td>
            <td>{{ $bookingCount }}</td>
        </tr>
        <tr>
            <td>Commissions</td>
            <td>{{ $workDescriptionCount + $jobRequestCount }}</td>
        </tr>
    </table>

    <h3>Additions Per Month</h3>
    <table>
        <tr>
            <th>Month</th>
            <th>Freelancers</th>
            <th>Customers</th>
            <th>Work Descriptions</th>
            <th>Job Requests</th>
        </tr>
        @for ($i = 1; $i <= 12; $i++)
            <tr>
                <td>{{ DateTime::createFromFormat('!m', $i)->format('F') }}</td>
                <td>{{ $freelancersPerMonth[$i] ?? 0 }}</td>
                <td>{{ $customersPerMonth[$i] ?? 0 }}</td>
                <td>{{ $workDescriptionsPerMonth[$i] ?? 0 }}</td>
                <td>{{ $jobRequestsPerMonth[$i] ?? 0 }}</td>
            </tr>
        @endfor
    </table>
</body>
</html>
