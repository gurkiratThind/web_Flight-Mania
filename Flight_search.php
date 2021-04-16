<?php

require_once 'WebPage.php';
require_once 'Tool.php';
require_once 'API.php';

class Flight_search
{
    public function search()
    {
        $home_page = new WebPage();
        $api = new API();
        $home_page->title = 'Welcome!';
        $from = '';
        $to = '';
        if (!isset($_GET['city'])) {
            if (isset($_POST['from']) && isset($_POST['to'])) {
                $from = $_POST['from'];
                $to = $_POST['to'];
                $message1 = 'Flight from '.$from.' to '.$to;
                $url = 'localhost:4000/user/';
                $method = 'search';
                $queryString = http_build_query([
        'departure' => $from,
        'arrival' => $to,
      ]);
            }
        } else {
            $from = 'Canada';
            $to = $_GET['city'];
            $message1 = 'Flight from '.$from.' to '.$to;
            $url = 'localhost:4000/user/';
            $method = 'search';
            $queryString = http_build_query([
        'departure' => $from,
        'arrival' => $to,
      ]);
        }
        $flight = $api->AccessAPI($url, $method, $queryString);
        $content = $this->HandleArray($flight, $message1);
        $home_page->Content = $content;
        $home_page->render();
    }

    public function searchAll()
    {
        $home_page = new WebPage();
        $api = new API();
        $home_page->title = 'Welcome!';
        $message1 = 'ALL FlIGHTS';
        $from = '';
        $to = '';
        if (!isset($_GET['city'])) {
            $from = '';
            $to = '';
            $url = 'localhost:4000/user/';
            $method = 'search';
            $queryString = http_build_query([
        'departure' => $from,
        'arrival' => $to,
      ]);
        } else {
            $from = '';
            $to = '';
            $url = 'localhost:4000/user/';
            $method = 'search';
            $queryString = http_build_query([
        'departure' => $from,
        'arrival' => $to,
      ]);
        }
        $flight = $api->AccessAPI($url, $method, $queryString);
        $content = $this->HandleArray($flight, $message1);
        $home_page->Content = $content;
        $home_page->render();
    }

    private function HandleArray($flight, $message1)
    {
        $r = '';
        $r .= '<div class=main>'.$message1.'</div>';
        $r .= '<div>';
        if (!empty($flight['data'])) {
            $r .= catalog($flight);
        // foreach ($flight['data'] as $key => $f) {
            //     $r .= '<div class=main>';
            //     $r .= '<div class=flightab>';
            //     $r .= '<p class= airline>'.$f['Departure'].'</p>';
            //     $r .= '<p class= from>'.$f['Diata'].'</p>';
            //     $r .= '<p class= from>TO</p>';
            //     $r .= '<p class= to>'.$f['Arrival'].'</p>';
            //     $r .= '<p class= date>'.$f['Aiata'].'</p>';
            //     $r .= '<a href="index.php?op=0"><button type="button" class="btn btn-light">Book</button></a>';
            //     $r .= '</div></div>';
            // }
        } else {
            $r .= '<div class=main style=color:red> No Flight Available</div>';
        }
        $r .= '</div>';

        return $r;
    }

    public function EditBooking()
    {
        $home_page = new WebPage();
        $api = new API();
        $message1 = 'Please set following fields';
        if (isset($_GET['dep']) && isset($_GET['arr'])) {
            $url = 'localhost:4000/user/';
            $method = 'search';
            $queryString = http_build_query([
        'departure' => $_GET['dep'],
        'arrival' => $_GET['arr'],
      ]);
            $flight = $api->AccessAPI($url, $method, $queryString);
        }
        $home_page->title = 'Welcome!';
        $home_page->Content = <<<HTML
        <div class="cardWrap">
        <form action="index.php?op=4" method="post">
        <div class="card cardLeft">
         <h1>Airline <span>{$flight['data'][0]['Airline_name']}</span></h1>
        <div class="from">
        <h2>{$flight['data'][0]['Departure']}</h2><span>From</span></div>
        <div class="to">
        <h2>{$flight['data'][0]['Arrival']}</h2>
        <span>TO</span>
        </div>
        <div class="dest">
        <h2>{$flight['data'][0]['Diata']}</h2>
        <span>Departure</span>
        </div>
        <div class="arr">
        <h2>{$flight['data'][0]['Aiata']}</h2>
        <span>Arrival</span>
        </div>
        <div class="time D">
        <h2>{$flight['data'][0]['scheduled']}</h2>
        <span>time Departure</span>
        </div>
        <div class="time A">
            <h2>{$flight['data'][0]['Ascheduled']}</h2>
            <span>time Arrival</span>
        </div>
        <div class="seat">
            <input required class="form-control" id="seat" type="number" value="1" min="1" max="10">
            <span>no. of seats</span>
        </div>
        <div class="type">
            <select required name="from" class="form-control">
                <option value="economy">Economy</option>
                <option value="business">Business</option>
            </select>
            <span>class</span>
        </div></div>
        <div class="card cardRight">
        <div class="eye"></div>
        <div class="number">
            <h3><span>$</span><input type="text" value="259" onclick="this.value" id="price"></h3>
            <span>Price</span>
        </div>
        <div class="barcode"></div></div>
        <button id="wish" class="btn btn-dark">Add to Wishlist</button></form>
        <form action="index.php?op=4" method="post">
        <button id="wish" class="btn btn-dark">Book</button>
        </form>
        </div>
        <script type="text/javascript">
        // var price=parseInt(document.getElementById("price").value);
        // function price(val){
        //     // seats=parseInt(document.getElementById("seat").value);
        //     document.getElementById("price").value=val*price;
        // }
        $(document).ready(function(){
            $("#seat").change(function(){
                alert("hello");
            $.ajax({url: "demo_test.php",
                type: 'POST',
                dataType: "json",
                data: {
                name: $("#seat").val(),
        } success: function(result){
            $("#div1").html(result);
            }});
            });
            });
        jQuery(function ($) {
        // price = $(this.#price).val();
        $('#price').text($('#seact').val());
        $('#seat').on('input', function () {
        $('#price').text($('#seat').val());
        });
        });
        </script>
        HTML;
        $home_page->render();
    }

    public function wishList()
    {
        $home_page = new WebPage();
        $api = new API();
        $home_page->title = 'Welcome!';

        if (!isset($_GET['city'])) {
            if (isset($_POST['from']) && isset($_POST['to'])) {
                $url = 'localhost:4000/user/';
                $method = 'searchall';
                $queryString = http_build_query();
            }
        } else {
            $from = 'Canada';
            $to = $_GET['city'];
            $url = 'localhost:4000/user/';
            $method = 'search';
            $queryString = http_build_query([
        'departure' => $from,
        'arrival' => $to,
      ]);
        }
        $flight = $api->AccessAPI($url, $method, $queryString);
        $content = $this->HandleArray($flight, $from, $to);
        $home_page->Content = $content;
        $home_page->render();
    }
}
