<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Commerce</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>Total Orders</th>
                <?php foreach ($statusTypes as $status): ?>
                <th><?php echo ucfirst($status); ?> Orders</th>
                <?php endforeach; ?>
                <th>Total Cost</th>
            </tr>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user->id; ?></td>
                <td><?php echo $user->name; ?></td>
                <td><?php echo $user->orders_count; ?></td>
                <?php foreach ($statusTypes as $status): ?>
                <td><?php echo $user->{$status . '_orders_count'}; ?></td>
                <?php endforeach; ?>
                <td><?php echo $user->orders_sum_total_cost; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</body>

</html>
