<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        $conn->query($sql);
    } elseif ($action === 'update') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
        $conn->query($sql);
    } elseif ($action === 'delete') {
        $id = $_POST['id'];

        $sql = "DELETE FROM users WHERE id=$id";
        $conn->query($sql);
    }
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

echo '<h2>Manage Users</h2>';
echo '<form id="userForm">';
echo '<input type="hidden" name="id" id="userId">';
echo '<input type="text" name="name" id="userName" placeholder="Name">';
echo '<input type="email" name="email" id="userEmail" placeholder="Email">';
echo '<input type="password" name="password" id="userPassword" placeholder="Password">';
echo '<button type="submit">Add User</button>';
echo '</form>';

echo '<table class="table">';
echo '<thead>';
echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>';
echo '</thead>';
echo '<tbody>';

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>
                <button onclick='editUser({$row['id']}, \"{$row['name']}\", \"{$row['email']}\")'>Edit</button>
                <button onclick='deleteUser({$row['id']})'>Delete</button>
            </td>
          </tr>";
}

echo '</tbody>';
echo '</table>';

$conn->close();
?>

<script>
document.getElementById('userForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const id = document.getElementById('userId').value;
    const name = document.getElementById('userName').value;
    const email = document.getElementById('userEmail').value;
    const password = document.getElementById('userPassword').value;

    let action = 'add';
    if (id) action = 'update';

    const formData = new FormData();
    formData.append('action', action);
    formData.append('id', id);
    formData.append('name', name);
    formData.append('email', email);
    formData.append('password', password);

    fetch('php/manage_users.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('content').innerHTML = data;
    });
});

function editUser(id, name, email) {
    document.getElementById('userId').value = id;
    document.getElementById('userName').value = name;
    document.getElementById('userEmail').value = email;
}

function deleteUser(id) {
    const formData = new FormData();
    formData.append('action', 'delete');
    formData.append('id', id);

    fetch('php/manage_users.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('content').innerHTML = data;
    });
}
</script>
