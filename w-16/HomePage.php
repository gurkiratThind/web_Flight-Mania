<?php

class Home
{
    // display home page
    public function HomePage()
    {
        $home_page = new WebPage();
        $home_page->title = 'Welcome!';
        // $home_page->Additional_css = 'HomePage.css';
        $home_page->Content = <<< HTML
        
    <div class="Slide-Show">
    <div class="container">
        <div class="slider">
            <div class="slides">
                <input type="radio" name="radio_btn" value="1" id="radio1" onclick="clickedPhoto(this.value)">
                <input type="radio" name="radio_btn" value="2" id="radio2" onclick="clickedPhoto(this.value)">
                <input type="radio" name="radio_btn" value="3" id="radio3" onclick="clickedPhoto(this.value)">
                <input type="radio" name="radio_btn" value="4" id="radio4" onclick="clickedPhoto(this.value)">
                <div class="slide first">
                    <img  src="destinationImg/albertabackground.jpg" alt="diamond">
                </div>
                <div class="slide">
                <img src="destinationImg/Calgarybackground.jpg" alt="diamond">
                </div>
                <div class="slide">
                <img src="destinationImg/quebeccitybackground.jpg" alt="diamond">
                </div>
                <div class="slide">
                <img src="destinationImg/torontobackground.jpg" alt="diamond">
                </div>
                <div class="navigation_auto">
                    <div class="auto_btn1"></div>
                    <div class="auto_btn2"></div>
                    <div class="auto_btn3"></div>
                    <div class="auto_btn4"></div>
                </div>
            </div>
            <div class="manual_navigation">
                <label for="radio1" class="manual_btn" id="radio-manual1"></label>
                <label for="radio2" class="manual_btn" id="radio-manual2"></label>
                <label for="radio3" class="manual_btn" id="radio-manual3"></label>
                <label for="radio4" class="manual_btn" id="radio-manual4"></label>
            </div>
        </div>
        <div class="mini-Slider">
            <div class="mini-slides">
                <input type="radio" name="mini-radio_btn" id="mini-radio1">
                <input type="radio" name="mini-radio_btn" id="mini-radio2">
                <input type="radio" name="mini-radio_btn" id="mini-radio3">
                <input type="radio" name="mini-radio_btn" id="mini-radio4">
                <div class="mini-slide second">
                <img src="destinationImg/albertamini.png" alt="diamond"/>
                </div>
                <div class="mini-slide">
                <img src="destinationImg/calgarymini.jpg" alt="diamond"/>
                </div>
                <div class="mini-slide">
                <img src="destinationImg/quebeccitymini.jpg" alt="diamond"/>
                </div>
                <div class="mini-slide">
                <img src="destinationImg/torontomini" alt="diamond"/>
                </div>
                <div class="mini-navigation_auto">
                    <div class="auto_btn1"></div>
                    <div class="auto_btn2"></div>
                    <div class="auto_btn3"></div>
                    <div class="auto_btn4"></div>
                </div>
            </div>
            <div class="mini-manual_navigation">
                <label for="mini-radio1" class="mini-manual_btn"></label>
                <label for="mini-radio2" class="mini-manual_btn"></label>
                <label for="mini-radio3" class="mini-manual_btn"></label>
                <label for="mini-radio4" class="mini-manual_btn"></label>
            </div>
        </div>
        <div class="book">
    <form action="index.php?op=2" method="POST" style="width:300px">
    <!-- <input type="hidden" name="op" value="2"> -->
        <h3>Book</h3>

    <div class="radio">
    <input type="radio" name="trip" required    value="return" class="form-control" id="return" checked><label for="return" >Return</label>
    <input type="radio" name="trip" required    value="one way" class="form-control" id="oneway"><label for="oneway" >One Way</label>
    <input type="radio" name="trip" required    value="multicity" class="form-control" id="multicity"><label for="multicity">Multicity</label><br>
    </div>
    <div class="depat-dest">
    <input type="text" name="departure" required maxlength="50" placeholder="From" value="" class="form-control">
    <input type="text" name="destination" required maxlength="50" placeholder="To" value="" class="form-control">
    </div>
    <div class="date">
    <div class="depart">
    <label for="depart">Depart</label>
    <input type="date" id="depart" class="form-control">
    </div>
    <div class="return">
    <label for="return">Return</label>
    <input type="date" id="return"  class="form-control">
    </div>
    </div>
    <div class="premium">
    <input type="checkbox" value="premium" id="buss" class="form-control"> 
    <label class="form-control" for="buss" id="buss-label">buisness/first<label>
    </div>
    <input type="submit" value="View flights" class="btn btn-secondary">
    </form>
    </div>
</div>
    </div>
    </div>
    
    
<script>
        function clickedPhoto(value) {
            document.getElementById("mini-radio" + value).checked = true;
        }
        var count = 1;
        

        setInterval(function () {
            document.getElementById("radio" + count).checked = true; 
            document.getElementById("mini-radio" + count).checked = true;
            count++;
            if (count > 4) {
                count = 1;
            }

        }, 10000);
    </script>
HTML;
        $home_page->render();
    }
}
