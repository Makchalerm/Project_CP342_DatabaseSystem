<nav class="navbar w3-black w3-card">

    <div class="w3-bar w3-white w3-card  w3-monospace w3-margin">
        <a href="home.php" class="w3-bar-item w3-button">Home</a>
        <a href="finance.php" class="w3-bar-item w3-button">Finance</a>
        
        <div class="w3-dropdown-click ">
            <button class="w3-button" style="height:38.5px" onclick="myFunction1()">2022 GRAPH</button>
            <div id="2022" class="w3-dropdown-content w3-bar-block w3-animate-zoom w3-red">
                <a class="w3-bar-item w3-button" href="../manager/best_seller.php">5 Best Seller</a>
                <a class="w3-bar-item w3-button" href="../manager/chart_month.php">Total Finance</a>
</div>
</div>

        <div class="w3-dropdown-click w3-right">
            <button class="w3-button" style="height:38.5px" onclick="myFunction()"><i class="fa fa-user"> <i class="fa fa-caret-down"></i></i></button>
            <div id="demo" class="w3-dropdown-content w3-bar-block w3-animate-zoom w3-green" style="right:0">
                <a class="w3-bar-item w3-button w3-red" href="../login/logout.php">Logout</a>
            </div>
        </div>
    </div>

</nav>

<script>
    function myFunction() {
        var x = document.getElementById("demo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
    
  
    
</script>
<script>
function myFunction1() {
        var a = document.getElementById("2022");
        if (a.className.indexOf("w3-show") == -1) {
            a.className += " w3-show";
        } else {
            a.className = a.className.replace(" w3-show", "");
        }
    }
    </script>