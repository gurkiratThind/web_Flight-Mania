<?php

class Tool
{
    public function AccessAPI($url, $method, $queryString)
    {
        $ch = curl_init($url.$method);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        $flight = json_decode($data, true);
        curl_close($ch);

        return $flight;
    }

    public function init()
    {
        if (!isset($_SESSION['userName'])) {
            $_SESSION['userName'] = '';
        }
        if (!isset($_SESSION['User_Id'])) {
            $_SESSION['User_Id'] = '';
        }
        if (!isset($_SESSION['User_email'])) {
            $_SESSION['User_email'] = '';
        }
    }
}

function catalog($flight)
{
    $r = '';
    foreach ($flight['data'] as $key => $f) {
        $dep = $f['Departure'];
        $arr = $f['Arrival'];
        // $r .= '<form Action=index.php?op=3 Method=POST>onclick=location.href="index.php?op=3" style="cursor:pointer;';
        $r .= '<div class="cardWrap" >';
        $r .= '<a href="index.php?op=3&dep='.$dep.'&arr='.$arr.'" >';
        $r .= '<div class="card cardLeft">';
        $r .= ' <h1>Airline <span>'.$f['Airline_name'].'</span></h1>';
        //$r .= substr(substr($f['Departure'], strpos($f['Departure'], ',') + 1), strpos(substr($f['Departure'], strpos($f['Departure'], ',') + 1), ',') + 1);
        $r .= '<div class="from">';
        $r .= '<h2>'.$f['Departure'].'</h2>';
        $r .= '<span>From</span>';
        $r .= '</div>';
        $r .= '<div class="to">';
        $r .= '<h2>'.$f['Arrival'].'</h2>';
        $r .= '<span>TO</span>';
        $r .= '</div>';
        $r .= '<div class="dest">';
        $r .= '<h2>'.$f['Diata'].'</h2>';
        $r .= '<span>Departure</span>';
        $r .= '</div>';
        $r .= '<div class="arr">';
        $r .= '<h2>'.$f['Aiata'].'</h2>';
        $r .= '<span>Arrival</span>';
        $r .= '</div>';

        $r .= '<div class="time D">';
        $r .= '<h2>'.date('h:i A', strtotime($f['scheduled'])).'</h2>';
        $r .= '<span>time Departure</span>';
        $r .= '</div>';

        $r .= '<div class="time A">';
        $r .= '<h2>'.date('h:i A', strtotime($f['Ascheduled'])).'</h2>';
        $r .= '<span>time Arrival</span>';
        $r .= '</div>';
        $r .= '<div class="seat">';
        $r .= '<h2>156</h2>';
        $r .= '<span>seat</span>';
        $r .= '</div>';
        $r .= '<div class="type">';
        $r .= '<h2>Economy</h2>';
        $r .= '<span>class</span>';
        $r .= '</div>';

        $r .= '</div>';
        $r .= '<div class="card cardRight">';
        $r .= '<div class="eye"></div>';
        $r .= '<div class="number">';
        $r .= '<h3><span>$</span>256</h3>';
        $r .= '<span>Price</span>';
        $r .= '</div>';
        $r .= '<div class="barcode"></div>';
        $r .= '</a>';
        $r .= '</div>';
        // $r .= '<input class="btn btn-dark" type="submit" value="Book">';
        // $r .= shell_exec("</div> <input type=hidden value=$dep name=departure><input type=hidden value=$arr name=departure>");
        // $r .= '</form>';
    }

    return $r;
}

function ExtractAirport($string)
{
    $countA = 0;
    $countB = 0;
    $newString = '';
    for ($i = strlen($string); $i > 0; --$i) {
        if ($string[$i] === ' ' && $countA === 0) {
            $countA = $i;
            // } elseif ($string[$i] === ',' && $countA != 0) {
        //     $countB = i;
        }
    }
    for ($i = $countA; $i < strlen($string); ++$i) {
        $newString .= $string[$i];
    }

    return $newString;
}
