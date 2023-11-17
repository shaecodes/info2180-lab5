<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country'])) {
    $country = htmlspecialchars($_GET['country']);
    $country = '%' . $country . '%'; 

    if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
        $stmt = $conn->prepare("
            SELECT cities.name AS city_name, cities.district, cities.population, countries.name AS country_name
            FROM cities
            JOIN countries ON cities.country_code = countries.code
        ");
    } else {
        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    }

    $stmt->bindParam(':country', $country, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $conn->query("SELECT * FROM countries");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<table>
    <thead>
    <tr>
        <?php if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities'): ?>
            <th>City Name</th>
            <th>District</th>
            <th>Population</th>
        <?php else: ?>
            <th>Country Name</th>
            <th>Continent</th>
            <th>Independence Year</th>
            <th>Head of State</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($results as $row): ?>
        <tr>
            <?php if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities'): ?>
                <td><?= $row['name']; ?></td>
                <td><?= $row['district']; ?></td>
                <td><?= $row['population']; ?></td>
            <?php else: ?>
                <td><?= $row['name']; ?></td>
                <td><?= $row['continent']; ?></td>
                <td><?= $row['independence_year']; ?></td>
                <td><?= $row['head_of_state']; ?></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
