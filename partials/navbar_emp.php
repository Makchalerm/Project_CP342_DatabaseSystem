<nav class="navbar w3-black w3-card">
    <div class="w3-bar w3-white w3-card  w3-monospace w3-margin">
        <a href="home.php" class="w3-bar-item w3-button">Cashier</a>
        <a href="history.php" class="w3-bar-item w3-button">History</a>

        <div class="w3-dropdown-click w3-right">
            <button class="w3-button" style="height:38.5px" onclick="myFunction()"><i class="fa fa-user"> <i class="fa fa-caret-down"></i></i></button>
            <div id="demo" class="w3-dropdown-content w3-bar-block w3-animate-zoom w3-green" style="right:0">
                <a class="w3-bar-item w3-button w3-red" href="#"  onclick="document.getElementById('info').style.display='block'" >Account</a>
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