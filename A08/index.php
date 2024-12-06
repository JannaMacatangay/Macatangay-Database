<?php
include("connect.php");

$departureFilter = $_GET['departureAirportCode'] ?? '';
$arrivalFilter = $_GET['arrivalAirportCode'] ?? '';
$airlineFilter = $_GET['airlineName'] ?? '';
$aircraftFilter = $_GET['aircraftType']??'';
$sort = $_GET['sort'] ?? '';
$order = $_GET['order'] ?? '';

$flightLogsQuery = "SELECT * FROM flightLogs";

if ($departureFilter != '' || $arrivalFilter != '' || $airlineFilter != '' || $aircraftFilter !='') {
    $flightLogsQuery = $flightLogsQuery . " WHERE";

    if ($departureFilter != '') {
        $flightLogsQuery = $flightLogsQuery . " departureAirportCode='$departureFilter'";
    }

    if ($departureFilter != '' && ($arrivalFilter != '' || $airlineFilter != '' || $aircraftFilter !='')) {
        $flightLogsQuery = $flightLogsQuery . " AND";
    }

    if ($arrivalFilter != '') {
        $flightLogsQuery = $flightLogsQuery . " arrivalAirportCode='$arrivalFilter'";
    }

    if ($arrivalFilter != '' && $airlineFilter != '') {
        $flightLogsQuery = $flightLogsQuery . " AND";
    }

    if ($airlineFilter != '') {
        $flightLogsQuery = $flightLogsQuery . " airlineName='$airlineFilter'";
    }

    if ($airlineFilter != '' && $aircraftFilter != '') {
        $flightLogsQuery = $flightLogsQuery . " AND";
    }
    if ($aircraftFilter != '') {
        $flightLogsQuery = $flightLogsQuery . " aircraftType='$aircraftFilter'";
    }


}

if ($sort != '') {
    $flightLogsQuery = $flightLogsQuery . " ORDER BY $sort";

    if ($order != '') {
        $flightLogsQuery = $flightLogsQuery . " $order";
    }
}

$flightLogsResults = executeQuery($flightLogsQuery);

$departureQuery = "SELECT DISTINCT(departureAirportCode) FROM flightLogs";
$departureResults = executeQuery($departureQuery);

$arrivalQuery = "SELECT DISTINCT(arrivalAirportCode) FROM flightLogs";
$arrivalResults = executeQuery($arrivalQuery);

$airlineQuery = "SELECT DISTINCT(airlineName) FROM flightLogs";
$airlineResults = executeQuery($airlineQuery);

$aircraftQuery = "SELECT DISTINCT(aircraftType) FROM flightLogs";
$aircraftResults = executeQuery($aircraftQuery );

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flight Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<style>

body {
    font-family: 'Poppins', sans-serif;
}
    .ms-3 {
        font-weight: bold;
    }

</style>

<body>
<div class="container-fluid my-5 text-center">
    <div class="row my-5 justify-content-center">
        <div class="col-lg-8 col-md-10">
            <form>
                <div class="card p-4 rounded-5" style="background-color: beige;">
                    <div class="h1 text-center mb-4">Filters</div>

                    <div class="d-flex flex-row justify-content-center flex-wrap">
                        <div class="ms-3">
                            <label for="departureSelect">Departure</label>
                            <div class="ms-2">
                                <select id="departureSelect" name="departureAirportCode" class="form-select" style="width: auto;">
                                    <option value="">Any</option>
                                    <?php
                                    if (mysqli_num_rows($departureResults) > 0) {
                                        while ($departureRow = mysqli_fetch_assoc($departureResults)) {
                                            ?>
                                            <option <?php if ($departureFilter == $departureRow['departureAirportCode']) { echo "selected"; } ?>
                                                value="<?php echo $departureRow['departureAirportCode']; ?>">
                                                <?php echo $departureRow['departureAirportCode']; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="ms-3">
                            <label for="arrivalSelect">Arrival</label>
                            <div class="ms-2">
                                <select id="arrivalSelect" name="arrivalAirportCode" class="form-select" style="width: auto;">
                                    <option value="">Any</option>
                                    <?php
                                    if (mysqli_num_rows($arrivalResults) > 0) {
                                        while ($arrivalRow = mysqli_fetch_assoc($arrivalResults)) {
                                            ?>
                                            <option <?php if ($arrivalFilter == $arrivalRow['arrivalAirportCode']) { echo "selected"; } ?>
                                                value="<?php echo $arrivalRow['arrivalAirportCode']; ?>">
                                                <?php echo $arrivalRow['arrivalAirportCode']; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="ms-3">
                            <label for="airlineSelect">Airline</label>
                            <div class="ms-2">
                                <select id="airlineSelect" name="airlineName" class="form-select" style="width: auto;">
                                    <option value="">Any</option>
                                    <?php
                                    if (mysqli_num_rows($airlineResults) > 0) {
                                        while ($airlineRow = mysqli_fetch_assoc($airlineResults)) {
                                            $selected = ($airlineFilter == $airlineRow['airlineName']) ? "selected" : "";
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $airlineRow['airlineName']; ?>">
                                                <?php echo $airlineRow['airlineName']; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="ms-3">
                            <label for="aircraftSelect">Aircraft</label>
                            <div class="ms-2">
                                <select id="aircraftSelect" name="aircraftType" class="form-select" style="width: auto;">
                                    <option value="">Any</option>
                                    <?php
                                    if (mysqli_num_rows($aircraftResults) > 0) {
                                        while ($aircraftRow = mysqli_fetch_assoc($aircraftResults)) {
                                            $selected = ($aircraftFilter == $aircraftRow['aircraftType']) ? "selected" : "";
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $aircraftRow['aircraftType']; ?>">
                                                <?php echo $aircraftRow['aircraftType']; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-center mb-6 mt-5">
                        <div class="me-3">
                            <label for="sort">Sort By</label>
                            <div class="ms-2">
                                <select id="sort" name="sort" class="form-select" style="width: auto;">
                                    <option value="" <?php if ($sort == "") echo "selected"; ?>>None</option>
                                    <option value="flightNumber" <?php if ($sort == "flightNumber") echo "selected"; ?>>Flight Number</option>
                                    <option value="departureDatetime" <?php if ($sort == "departureDatetime") echo "selected"; ?>>Departure Time</option>
                                    <option value="arrivalDatetime" <?php if ($sort == "arrivalDatetime") echo "selected"; ?>>Arrival Time</option>
                                </select>
                            </div>
                        </div>

                        <div class="me-3">
                            <label for="order">Order</label>
                            <div class="ms-2">
                                <select id="order" name="order" class="form-select" style="width: auto;">
                                    <option value="ASC" <?php if ($order == "ASC") echo "selected"; ?>>Asc</option>
                                    <option value="DESC" <?php if ($order == "DESC") echo "selected"; ?>>Desc</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button class="btn btn-primary" style="width: fit-content">Apply</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


    <div class="row my-5 mx-5">
        <div class="col">
            <div class="card p-4 rounded-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Flight Number</th>
                            <th scope="col">Departure</th>
                            <th scope="col">Arrival</th>
                            <th scope="col">Airline</th>
                            <th scope="col">Aircraft</th>
                            <th scope="col">Departure Time</th>
                            <th scope="col">Arrival Time</th>
                            <th scope="col">Pilot Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($flightLogsResults) > 0) {
                            while ($flightRow = mysqli_fetch_assoc($flightLogsResults)) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $flightRow['flightNumber']; ?></th>
                                    <td><?php echo $flightRow['departureAirportCode']; ?></td>
                                    <td><?php echo $flightRow['arrivalAirportCode']; ?></td>
                                    <td><?php echo $flightRow['airlineName']; ?></td>
                                    <td><?php echo $flightRow['aircraftType']; ?></td>
                                    <td><?php echo $flightRow['departureDatetime']; ?></td>
                                    <td><?php echo $flightRow['arrivalDatetime']; ?></td>
                                    <td><?php echo $flightRow['pilotName']; ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
