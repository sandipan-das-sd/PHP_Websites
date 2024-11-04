<?php
include('header.php');
checkUser();
restrictAccess();
?>

<script>
(function(w, d) {
    w.CollectId = "64ee08c817960a15b2334ca0";
    var h = d.head || d.getElementsByTagName("head")[0];
    var s = d.createElement("script");
    s.setAttribute("type", "text/javascript");
    s.async = true;
    s.setAttribute("src", "https://collectcdn.com/launcher.js");
    h.appendChild(s);
})(window, document);
</script>

<script>
        function openSmallWindow() {
            // Define the window features (dimensions, position, etc.)
            var windowFeatures = 'width=500,height=550,resizable=yes';

            // Open a new window with the specified features
            var smallWindow = window.open('cal2.php', '_blank', windowFeatures);
                                          //cal.html mal take call kora
            // Focus on the newly opened window
            if (smallWindow) {
                smallWindow.focus();
            }
}
</script>

<button onclick="openSmallWindow()" style="
           position: absolute;
           top: 20px;
           right: 10px;
           font-weight: bold;
           text-decoration: none;
           border: 2px solid #000;
           padding: 10px 20px;
           border-radius: 10px;
           background-color: #f2f2f2;
           color: #000;
           cursor: pointer;
       "
    >
        Calculator
    </button>
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('today')?></h2>
                                                <span>Today's Expense</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('yesterday')?></h2>
                                                <span>Yesterday's Expense</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                        </div>
                                    </div>
                                 </div>
                            </div>
							<div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('week')?></h2>
                                                <span>This Week Expense</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('month')?></h2>
                                                <span>This Month Expense</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('year')?></h2>
                                                <span>This Year Expense</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('total')?></h2>
                                                <span>Total Expense</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->


    
<?php
include('footer.php');
?> 