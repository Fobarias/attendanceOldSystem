<?php
include('modal/autoload.php');

$empView = new employeeView();
?>


<!DOCTYPE html>f
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Condica prezenta</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">

      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
  </header>

  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!--<li class="nav-item">
        <a class="nav-link collapsed" href="manage-emp.php">
          <i class="bi bi-grid"></i>
          <span>Gestionare angajati</span>
        </a>
      </li>-->
      <li class="nav-item">
        <a class="nav-link collapsed" href="freetime.php">
          <i class="bi bi-calendar-range-fill"></i>
          <span>Concedii</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="export.php">
          <i class="bi bi-download"></i>
          <span>Export</span>
        </a>
      </li>

      <li class="nav-heading">Altele</li>

      <!--<li class="nav-item">
        <a class="nav-link collapsed" href="settings.php">
          <i class="bi bi-gear"></i>
          <span>Setari</span>
        </a>
      </li>-->

    </ul>

  </aside>

  <div class="modal fade" id="verticalycentered" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" id="editBody">

      </div>
    </div>
  </div>

  <div class="modal fade" id="addEmployee" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">ADAUGA DATE</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row g-3">
          <div id="errorEmp">

          </div>
          <div class="col-md-12">
            <label for="employeeSelect" class="form-label">ANGAJAT</label>
            <select name="employee" id="employeeSelect" class="form-select">
              <option value="0" selected disabled require>SELECTEAZA UN ANGAJAT</option>
              <?php $empView->displayEmp(); ?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="arrTimeEmp" class="form-label">Ora sosire</label>
            <input type="time" class="form-control" id="arrTimeEmp" class="">
          </div>
          <div class="col-md-6">
            <label for="levTimeEmp" class="form-label">Ora plecare</label>
            <input type="time" id="levTimeEmp" class="form-control id=" levTime">
          </div>
          <div class="col-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="vacEmp">
              <label class="form-check-label" for="gridCheck">
                In concediu?
              </label>
            </div>
          </div>
          <div class="col-12">
            <label for="inputAddress2" class="form-label">Data</label>
            <input type="date" id="datePickerEmp" class="form-control" id="inputAddress2">
            <script>
              document.getElementById('datePickerEmp').valueAsDate = new Date();
            </script>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Inchide</button>
          <button type="button" onclick="saveData()" class="btn btn-primary">Salveaza</button>
        </div>
      </div>
    </div>
  </div>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
      <div class="row">
        <div class="">
          <div class="row">

            <div class="col-xxl-4 col-xl-12">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Angajati in concediu <span>| Astazi</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php $empView->employeeOnVacation(); ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-xl-12">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Intrari <span>| Pe luna</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php $empView->totalMonth(); ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <!--<div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                        <a href="manage-emp.php"><button type="button" class="btn btn-outline-primary">GESTIONEAZA ANGAJATII</button></a>
                    </div>
                  </div>
                </div>

              </div>
            </div>-->

            <div class="col-xxl-4 col-xl-12">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title"></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <a href="freetime.php"><button type="button" class="btn btn-outline-primary">CONCEDII</button></a>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-xl-12">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title"></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <a href="export.php"><button type="button" class="btn btn-outline-primary">EXPORT
                          DATE</button></a>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="card">
              <div class="card-body">
                <button type="button" class="btn btn-success mt-3 mb-2" data-bs-toggle="modal" data-bs-target="#addEmployee">ADAUGA DATE</button>
                <div class="d-flex align-items-center mt-2">
                  <label for="inputDate" class="col-form-label" style="margin-right: 5px;">Data</label>
                  <div class="w-50 ">
                    <input type="date" id="datePicker" class="form-control">
                    <script>
                      document.getElementById('datePicker').valueAsDate = new Date();
                    </script>
                  </div>
                </div>
                <table class="table table-hover mt-3">
                  <thead>
                    <tr>
                      <th scope="col" id="hideMobile">#</th>
                      <th scope="col">Nume</th>
                      <th scope="col">Data</th>
                      <th scope="col">Ora sosire</th>
                      <th scope="col" id="hideTable" style="width: 20%">Semnatura la sosire</th>
                      <th scope="col">Ora plecare</th>
                      <th scope="col" id="hideTable" style="width: 20%">Semnatura la plecare</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody id="showTable">
                    <?php $empView->getFirstEntrance(); ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


          <!-- Pagination with icons -->
          <!-- End Pagination with icons -->
        </div>
    </section>
    </div>
    </div>
    </section>

  </main>

  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span></span></strong>. Toate drepturile rezervate
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/requests.js"></script>

</body>

</html>