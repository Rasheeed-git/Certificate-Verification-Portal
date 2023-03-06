	<!--Show Modal Script-->
	<script>
var modal = document.getElementById('login-form');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
	</script>
	<!--/Show Modal Script-->

	<!--Show and Hide Password Script-->
	<script>
$(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
	</script>
	<!--/Show and Hide Password Script-->

	<!--Accept Only Alphabet for Input-->
	<script>
function alphaOnly() {
    let nameInput = document.querySelectorAll('.name');
    nameInput.forEach((input) => {

        input.addEventListener('keydown', (e) => {
            let charCode = e.keyCode;

            if ((charCode >= 65 && charCode <= 90) || charCode == 8 || charCode == 32) {
                null;
            } else {
                e.preventDefault();
            }
        });
    });
}

alphaOnly();
	</script>
	<!--/Accept Only Alphabet for Input-->
  
<!--Chart Script-->
	<script>
const inputs = document.querySelectorAll(".input");


function addcl() {
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

function remcl() {
    let parent = this.parentNode.parentNode;
    if (this.value == "") {
        parent.classList.remove("focus");
    }
}


inputs.forEach(input => {
    input.addEventListener("focus", addcl);
    input.addEventListener("blur", remcl);
});
	</script>


	<?php

require('connection/connection_db.php');
$query = "SELECT COUNT(id) as total FROM student_tbl";
$stmt = $connect->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$total = $result['total'];
// Select the last Session from the table where is Active
$session_query = "SELECT * FROM Session_Tbl WHERE SessionStatus = 'Active' ORDER BY id DESC LIMIT 1";
$session_statement = $connect->prepare($session_query);
$session_statement->execute();
$session_result = $session_statement->fetch(PDO::FETCH_ASSOC);
$session_statement->closeCursor();
$display_currentsession = $session_result['SessionName'];
?>
	<!--Chart Script-->
	<script>
var total = <?php echo json_encode($total); ?>;
var session = <?php echo json_encode($display_currentsession); ?>;
const charts = document.querySelectorAll(".chart");
charts.forEach(function(chart) {
    var ctx = chart.getContext("2d");
    var myChart = new Chart(ctx, {
        type: "bar",
        data: {

            labels: ['Session: ' + session],
            datasets: [{
                label: "Verified Students Chart",
                data: [total],
                backgroundColor: [
                    "rgba(240, 154, 62, 0.2)",
                ],
                borderColor: [
                    "rgba(240, 154, 62, 1)",
                ],
                borderWidth: 1,
            }, ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
});

$(document).ready(function() {
    $(".data-table").each(function(_, table) {
        $(table).DataTable();
    });
});
	</script>

	<script>
// Get the file input and button elements
var fileInput = document.getElementById('file-input');
var fileButton = document.getElementById('file-button');

// Add a click event listener to the button
fileButton.addEventListener('click', function() {
    // Trigger the click event on the file input
    event.preventDefault();
    fileInput.click();
});
	</script>