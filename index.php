<?php
define("BASEURL", "http://localhost/date_holidays/index.php");
$api_key = 'cf6b8ea5093c49aba198a9238f1ce535aad8563eb7acfe37d19d5a4a0233e945';
$country = 'ID';
$year = date('Y');
$url = 'https://calendarific.com/api/v2/holidays?api_key=' . $api_key . '&country=' . $country . '&year=' . $year;

//Implementasi request get public API menggunakan CURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);

//$temp = file_get_contents('data.json');
$data = json_decode($result, true);
$holiday = $data['response']['holidays'];


if (isset($_GET['bulan'])) {
  $month = $_GET['bulan'];
} else {
  $month = date('n');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Date Holidays</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <div class="container-fluid header">
      <h1>DATE HOLIDAYS</h1>
      by zadlyka
    </div>
  </header>

  <main class="container p-3">
    <section>
      <div class="card my-3">
        <div class="row g-0 align-items-center">
          <div class="col-md-4">
            <img src="img/undraw_festivities_tvvj.svg" class="img-fluid rounded-start m-3" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body text-center">
              <h1><?= date('d F Y'); ?></h1>
              <span class="country">Indonesia</span>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>

    <section>
      <div class="dropdown mb-3">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          <?php
          if (isset($_GET['bulan'])) {
            $dateObj = DateTime::createFromFormat('!m', $_GET['bulan']);
            echo $dateObj->format('F');
          } else {
            echo 'Bulan';
          }
          ?>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="<?= BASEURL; ?>?bulan=1">January</a></li>
          <li><a class="dropdown-item" href="<?= BASEURL; ?>?bulan=2">February</a></li>
          <li><a class="dropdown-item" href="<?= BASEURL; ?>?bulan=3">March</a></li>
          <li><a class="dropdown-item" href="<?= BASEURL; ?>?bulan=4">April</a></li>
          <li><a class="dropdown-item" href="<?= BASEURL; ?>?bulan=5">Mei</a></li>
          <li><a class="dropdown-item" href="<?= BASEURL; ?>?bulan=6">June</a></li>
          <li><a class="dropdown-item" href="<?= BASEURL; ?>?bulan=7">July</a></li>
          <li><a class="dropdown-item" href="<?= BASEURL; ?>?bulan=8">August</a></li>
          <li><a class="dropdown-item" href="<?= BASEURL; ?>?bulan=9">September</a></li>
          <li><a class="dropdown-item" href="<?= BASEURL; ?>?bulan=10">October</a></li>
          <li><a class="dropdown-item" href="<?= BASEURL; ?>?bulan=11">November</a></li>
          <li><a class="dropdown-item" href="<?= BASEURL; ?>?bulan=12">Desember</a></li>
        </ul>
      </div>

      <div class="row ">
        <div class="col">
          <div class="card">
            <ul class="list-group list-group-flush">
              <?php foreach ($holiday as $data) : ?>
                <?php if ($data['date']['datetime']['month'] == $month) : ?>
                  <li class="list-group-item list-group-item-action 
                    <?php if ($data['date']['iso'] == date('Y-m-d')) {
                      echo 'active';
                    } ?>
                  ">
                    <div class="m-2">
                      <h5><?= $data['name']; ?></h5>
                      <p><?= $data['description']; ?></p>
                      <p><?= $data['date']['iso']; ?></p>
                    </div>
                  </li>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <div class="container-fluid bg-dark text-center text-white p-4">
      &copy;Zadlyka 2021
    </div>
  </footer>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
</body>

</html>