<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if($_GET["context"] == 'cities'){
  $cities = TRUE;
  if( $_GET["country"]){ 
    $country = filter_var($_GET["country"], FILTER_SANITIZE_STRING);
    $stmt = $conn->query("SELECT 
    cities.name,
    cities.district, 
    cities.population 
    FROM cities
    INNER JOIN countries
    ON cities.country_code=countries.code
    WHERE countries.name LIKE '%$country%';");
  }
  else{
    $stmt = $conn->query("SELECT cities.name AS name, cities.district AS district, 
    cities.population AS population FROM cities 
     ");
  }
  
}else if($_GET["context"] == 'country'){
  $cities = FALSE;
  if( $_GET["country"]){
    $country = filter_var($_GET["country"], FILTER_SANITIZE_STRING);
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  }
  else{
    $stmt = $conn->query("SELECT * FROM countries");
  }
}

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<table>
<?php if($cities):?>
  <tr>
      <th>Name</th>
      <th>District</th>
      <th>Population</th>
    </tr>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name'] ?></td>
      <td><?= $row['district'] ?></td>
      <td><?= $row['population'] ?></td>
    </tr>
  <?php endforeach; ?>
<?php endif;?>

<?php if(!$cities):?>
  <tr>
      <th>Name</th>
      <th>Continent</th>
      <th>Independence</th>
      <th>Head of State</th>
    </tr>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name'] ?></td>
      <td><?= $row['continent'] ?></td>
      <td><?= $row['independence_year'] ?></td>
      <td><?= $row['head_of_state'] ?></td>
    </tr>
  <?php endforeach; ?>
<?php endif;?>

</table>
