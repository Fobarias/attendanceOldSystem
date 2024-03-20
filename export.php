<!DOCTYPE html>
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
                <img src="assets/img/logo-200.svg" alt="">
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

    </header>

    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php">
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
                <a class="nav-link" href="export.php">
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

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Concedii</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Concedii</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <?php
                            require 'vendor/autoload.php';
                            include('modal/autoload.php');

                            use PhpOffice\PhpSpreadsheet\Spreadsheet;
                            use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
                            use PhpOffice\PhpSpreadsheet\Style\Alignment;
                            use PhpOffice\PhpSpreadsheet\IOFactory;
                            use PhpOffice\PhpSpreadsheet\Style\Border;
                            use PhpOffice\PhpSpreadsheet\Style\Color;

                            $empConn = new employeeController();

                            if (isset($_POST['export'])) {
                                $date = $_POST['month'];
                                $dateArray = explode('-', $date);

                                if ($date == null) {
                                    echo 'Selecta-ti o data!';
                                } else {
                                    $spreadsheet = new Spreadsheet();
                                    $sheet       = $spreadsheet->getActiveSheet();

                                    $sheet->mergeCells("A1:G1");
                                    $sheet->getStyle("A1:G1")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                                    $sheet->setCellValue("A1", 'Condica prezenta');

                                    $sheet->mergeCells("A2:C2");
                                    $sheet->setCellValue("A2", 'Anul: ' . $dateArray[0] . ' | Luna: ' . $dateArray[1]);

                                    $sheet->getColumnDimension('A')->setWidth(6);
                                    $sheet->getColumnDimension('B')->setWidth(21);
                                    $sheet->getColumnDimension('C')->setWidth(11);
                                    $sheet->getColumnDimension('D')->setWidth(9);
                                    $sheet->getColumnDimension('E')->setWidth(13);
                                    $sheet->getColumnDimension('F')->setWidth(11);
                                    $sheet->getColumnDimension('G')->setWidth(13);

                                    $sheet->setCellValue("A3", 'Nr. Crt');
                                    $sheet->setCellValue("B3", 'Nume');
                                    $sheet->setCellValue("C3", 'Data');
                                    $sheet->setCellValue("D3", 'Ora sosire');
                                    $sheet->setCellValue("E3", 'Semnatura');
                                    $sheet->setCellValue("F3", 'Ora plecare');
                                    $sheet->setCellValue("G3", 'Semnatura');

                                    $entranceData = $empConn->getEntranceMonth($date . '%');
                                    $k = 4;
                                    while ($row = $entranceData->fetch()) {
                                        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                        $drawings = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                        $empName = $empConn->getEmpName($row['uid']);
                                        $signature = $empConn->getSignature($row['uid']);
                                        $sheet->setCellValue("A" . $k, $k);
                                        $sheet->setCellValue("B" . $k, $empName['name']);
                                        $sheet->setCellValue("C" . $k, $row['date']);
                                        $sheet->setCellValue("D" . $k, $row['arrivalTime']);
                                        if ($signature['signature'] != '') {
                                            $cell = 'E' . $k;
                                            $drawing->setName('Employee signature');
                                            $drawing->setCoordinates($cell);
                                            $drawing->setDescription('Employee signature');
                                            $drawing->setPath('assets/img/' . $signature['signature']); // put your path and image here
                                            $drawing->setOffsetX(6);

                                            if ($signature['signature'] == 'balmus-7766695528.png') {
                                                $drawing->setOffsetY(2);
                                                $drawing->setWidth(30);
                                                $drawing->setHeight(30);
                                            } else {
                                                $drawing->setWidth(50);
                                                $drawing->setHeight(50);
                                            }
                                            $drawing->setWorksheet($sheet);
                                        }
                                        $sheet->setCellValue("F" . $k, $row['leavingTime']);
                                        if ($signature['signature'] != '' && $row['leavingTime'] != '') {
                                            $drawings->setName('Employee signature');
                                            $drawings->setDescription('Employee signature');
                                            $drawings->setPath('assets/img/' . $signature['signature']); // put your path and image here
                                            $drawings->setCoordinates('G' . $k);
                                            $drawings->setOffsetX(6);

                                            if ($signature['signature'] == 'balmus-7766695528.png') {
                                                $drawings->setOffsetY(2);
                                                $drawings->setWidth(30);
                                                $drawings->setHeight(30);
                                            } else {
                                                $drawings->setWidth(50);
                                                $drawings->setHeight(50);
                                            }
                                            $drawings->setWorksheet($sheet);
                                        }
                                        $sheet->getRowDimension($k)->setRowHeight(40);
                                        $k++;
                                    }

                                    $spreadsheet->getActiveSheet()->getStyle('A3:G' . $k)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
                                    $sheet = $spreadsheet->getActiveSheet()->setAutoFilter('A3:G' . $k - 1);
                                    $sheet->getStyle('A3:G' . $k)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
                                    $sheet->getStyle("A1:G1")->getFont()->setSize(20);
                                    $sheet->getStyle('A3:G3')->getFont()->setBold(true);
                                    $writer = new Xlsx($spreadsheet);
                                    $writer->save('date_export/' . $date . ".xlsx");
                                    echo '
                                        <div class="alert mt-3 border-success alert-dismissible fade show" role="alert">
                                            Fisierul a fost exportat.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                                }
                            }
                            ?>
                            <h5 class="card-title">Export date</h5>
                            <form method="POST">
                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Data</label>
                                    <div class="col-sm-10">
                                        <input type="month" name="month" class="form-control">
                                        <script>
                                            document.getElementById('datePicker').valueAsDate = new Date();
                                        </script>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <input type="submit" name="export" class="btn btn-primary" value="Export">
                                </div>
                            </form>

                        </div>
                    </div>

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

    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>