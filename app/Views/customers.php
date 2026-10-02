<!DOCTYPE html>
<html>
<head>
    <title>Customer Accounts</title>
</head>
<body>

<h1>Customer Accounts</h1>

<nav>
    <a href="/">Home</a> |
    <a href="/customers">Customers</a> |
    <a href="/users">Users</a>
	
	<br>

<a href="/customers/new">Add New Customer</a>

<br><br>

</nav>

<br>

<table border="1" cellpadding="10">
    <tr>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
		<th>Action</th>
    </tr>

    <?php foreach ($customers as $customer): ?>
        <tr>
            <td><?= esc($customer['full_name']) ?></td>
            <td><?= esc($customer['email']) ?></td>
            <td><?= esc($customer['phone']) ?></td>
			<td>
				<a href="/customers/edit/<?= $customer['id'] ?>">Edit</a>
			</td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
