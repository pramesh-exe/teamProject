<?php
include('connect.php');

// Check if the user is logged in
if ((empty(strtolower($_SESSION['email']))) || (empty($_SESSION['id']))) {
    header('location:../Login.php');
}

// Function to display collection days
function collection(){
    date_default_timezone_set("Asia/Kathmandu");
    $a = date("Y/m/d");
    $b = date("l");
    $c = date("h:i:sa");

    if ($b == "Sunday" || $b == "Monday" || $b =="Tuesday") {
        $day1 = <<<SPLIT
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
SPLIT;
        echo $day1;
    } else if($b == "Wednesday") {
        $day2 = <<<SPLIT
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
SPLIT;
        echo $day2;
    } else if($b == "Thursday") {
        $day1 = <<<SPLIT
            <option value="Friday">Friday</option>
            <option value="Wednesday">Next Wednesday</option>
SPLIT;
        echo $day1;
    } else if($b == "Friday") {
        $day1 = <<<SPLIT
            <option value="Wednesday">Next Wednesday</option>
            <option value="Thursday">Next Thursday</option>
SPLIT;
        echo $day1;
    } else {
        $day1 = <<<SPLIT
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
SPLIT;
        echo $day1;
    }
}


// Function to display collection time slots
function timer(){
    $b = date("l");
    $c = date("h G");

    if ($b == "Sunday" || $b == "Monday" || $b =="Tuesday" || $b == "Saturday") {
        $d5 = <<<SPLIT
            <option value="10am to 1pm">10 a.m to 1 p.m</option>
            <option value="1pm to 4pm">1 p.m to 4 p.m</option>
            <option value="4pm to 7pm">4 p.m to 7 p.m</option>
SPLIT;
        echo $d5;
    } else {
        if ($c > "18" || $c < "10"){
            $d1 = <<<SPLIT
                <option value="10am to 1pm">10 a.m to 1 p.m</option>
                <option value="1pm to 4pm">1 p.m to 4 p.m</option>
                <option value="4pm to 7pm">4 p.m to 7 p.m</option>
SPLIT;
            echo $d1;
        } elseif ($c < 13) {
            $d2 = <<<SPLIT
                <option value="1pm to 4pm">1 p.m to 4 p.m</option>
                <option value="4pm to 7pm">4 p.m to 7 p.m</option>
SPLIT;
            echo $d2;
        } elseif ($c < 16) {
            $d3 = <<<SPLIT
                <option value="4pm to 7pm">4 p.m to 7 p.m</option>
SPLIT;
            echo $d3;
        }
    }
}
?>
<!-- HTML form -->
<form>
    <label for="collection_day">Select Collection Day:</label>
    <select name="collection_day" id="collection_day">
        <?php collection(); ?>
    </select>

    <label for="collection_time">Select Collection Time:</label>
    <select name="collection_time" id="collection_time">
        <?php timer(); ?>
    </select>

    <button type="submit">Submit</button>
</form>