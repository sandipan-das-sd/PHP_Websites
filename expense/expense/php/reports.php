<?php
include('header.php');
checkUser();
restrictAccess();
include('user_header.php');

$cat_id = '';
$sub_sql = '';
$from = '';
$to = '';
if(isset($_GET['category_id']) && $_GET['category_id'] > 0){
    $cat_id = get_safe_value($_GET['category_id']);
    $sub_sql = " and category.id = $cat_id ";
}

if(isset($_GET['from'])){
    $from = get_safe_value($_GET['from']);
}
if(isset($_GET['to'])){
    $to = get_safe_value($_GET['to']);
}

if($from !== '' && $to != ''){
    $sub_sql .= " and expense.expense_date BETWEEN '$from' AND '$to' ";
}

$res = mysqli_query($con, "SELECT sum(expense.price) as price, category.name FROM expense, category WHERE expense.category_id = category.id AND expense.added_by = '".$_SESSION['UID']."' $sub_sql  GROUP BY expense.category_id");
$data = array(); 
while($row = mysqli_fetch_assoc($res)){
    $data[] = $row; 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Expense Reports</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <h2>Reports</h2>

    <form method="get">
        From <input type="date" name="from" value="<?php echo $from ?>" max="<?php echo date('Y-m-d') ?>" onchange="set_to_date()" id="from_date">
        
        &nbsp;&nbsp;&nbsp;
        To <input type="date" name="to"  value="<?php echo $to ?>"  max="<?php echo date('Y-m-d') ?>"  id="to_date">
        
        <?php echo getCategory($cat_id, 'reports'); ?>
        
        <input type="submit" name="submit" value="Submit">
        <a href="reports.php">Reset</a>
    </form>

    <?php if(mysqli_num_rows($res) > 0){ ?>
        <br/><br/>
        <table border="1">
            <tr>
                <th>Category</th>
                <th>Price</th>
            </tr>
            
            <?php 
            $final_price = 0;
            foreach($data as $row){
                $final_price += $row['price'];    
            ?>
            <tr>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['price'] ?></td>
            </tr>
            <?php } ?>
            
            <tr>
                <th>Total</th>
                <th><?php echo $final_price ?></th>
            </tr>
            
        </table>
    <?php } else {
        echo "<b>No data found</b>";
    } ?>

    <div id="expenseChartContainer" style="width: 300px; height: 300px;">
        <canvas id="expenseChart"></canvas>
    </div>
    
    <script>
        
        var chartData = <?php echo json_encode($data); ?>;
        
        var categories = chartData.map(item => item.name);
        var prices = chartData.map(item => item.price);
        
        var ctx = document.getElementById('expenseChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categories,
                datasets: [{
                    label: 'Expense',
                    data: prices,
                    backgroundColor: generateRandomColors(prices.length), // Generate random colors
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false, 
                maintainAspectRatio: false, 
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0 
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false 
                    }
                }
            }
        });
          
        function generateRandomColors(count) {
            var colors = [];
            for (var i = 0; i < count; i++) {
                var color = `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, 0.6)`;
                colors.push(color);
            }
            return colors;
        }
    </script>

    
</body>
</html>
<?php 
include('footer.php'); 
?>