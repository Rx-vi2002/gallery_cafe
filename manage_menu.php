<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        $sql = "INSERT INTO menu_items (name, description, price, category) VALUES ('$name', '$description', '$price', '$category')";
        $conn->query($sql);
    } elseif ($action === 'update') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        $sql = "UPDATE menu_items SET name='$name', description='$description', price='$price', category='$category' WHERE id=$id";
        $conn->query($sql);
    } elseif ($action === 'delete') {
        $id = $_POST['id'];

        $sql = "DELETE FROM menu_items WHERE id=$id";
        $conn->query($sql);
    }
}

$sql = "SELECT * FROM menu_items";
$result = $conn->query($sql);

echo '<h2>Manage Menu Items</h2>';
echo '<form id="menuForm">';
echo '<input type="hidden" name="id" id="menuId">';
echo '<input type="text" name="name" id="menuName" placeholder="Name">';
echo '<textarea name="description" id="menuDescription" placeholder="Description"></textarea>';
echo '<input type="text" name="price" id="menuPrice" placeholder="Price">';
echo '<select name="category" id="menuCategory">';
echo '<option value="appetizers">Appetizers</option>';
echo '<option value="mains">Mains</option>';
echo '<option value="desserts">Desserts</option>';
echo '<option value="beverages">Beverages</option>';
echo '</select>';
echo '<button type="submit">Add Item</button>';
echo '</form>';

echo '<table class="table">';
echo '<thead>';
echo '<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Category</th><th>Actions</th></tr>';
echo '</thead>';
echo '<tbody>';

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['description']}</td>
            <td>{$row['price']}</td>
            <td>{$row['category']}</td>
            <td>
                <button onclick='editMenu({$row['id']}, \"{$row['name']}\", \"{$row['description']}\", \"{$row['price']}\", \"{$row['category']}\")'>Edit</button>
                <button onclick='deleteMenu({$row['id']})'>Delete</button>
            </td>
          </tr>";
}

echo '</tbody>';
echo '</table>';

$conn->close();
?>

<script>
document.getElementById('menuForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const id = document.getElementById('menuId').value;
    const name = document.getElementById('menuName').value;
    const description = document.getElementById('menuDescription').value;
    const price = document.getElementById('menuPrice').value;
    const category = document.getElementById('menuCategory').value;

    let action = 'add';
    if (id) action = 'update';

    const formData = new FormData();
    formData.append('action', action);
    formData.append('id', id);
    formData.append('name', name);
    formData.append('description', description);
    formData.append('price', price);
    formData.append('category', category);

    fetch('php/manage_menu.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('content').innerHTML = data;
    });
});

function editMenu(id, name, description, price, category) {
    document.getElementById('menuId').value = id;
    document.getElementById('menuName').value = name;
    document.getElementById('menuDescription').value = description;
    document.getElementById('menuPrice').value = price;
    document.getElementById('menuCategory').value = category;
}

function deleteMenu(id) {
    const formData = new FormData();
    formData.append('action', 'delete');
    formData.append('id', id);

    fetch('php/manage_menu.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('content').innerHTML = data;
    });
}
</script>
