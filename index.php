<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        body{
            font-family:arial;
        }
        .table-col-size{
            width:25%;
        }
    </style>
</head>
<body>
    
<div class="container">
  <div class="row">
    <div class="offset-2 col-sm-8">
        <div class="card mt-3">
            <div class="card-header">
                <h2 class="text-center">Add Your Recipe</h2>
            </div>
            <div class="card-body">
                <form id="recipeForm" method="POST">
                    <div class="form-group">
                        <label>Recipe Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control" id="category">
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Range From</label>
                        <input type="text" class="form-control" id="rangeFrom" name="name">
                    </div>
                    <div class="form-group">
                        <label>Range To</label>
                        <input type="text" class="form-control" id="rangeTo" name="name">
                    </div>
                    <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary float-right">Add Recipe</button>
                </form>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm">
        <div class="card mt-3">
            <div class="card-header">
                <p class="float-right">
                    <button class="btn text-primary" onclick="downloadCSV()">Download CSV</button>
                </p>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="recipeTable">
                    <thead>
                        <tr>
                            <th scope="col">Recipe Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Range From</th>
                            <th scope="col">Range To</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="script.js"></script>
<script>

    function downloadCSV() {
        var table = document.getElementById("recipeTable");
        var rows = table.querySelectorAll("tr");
        var csv = [];

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
            }

            csv.push(row.join(","));
        }

        // Create a Blob containing the CSV data
        var blob = new Blob([csv.join("\n")], { type: "text/csv" });

        // Create a link element and trigger the download
        var link = document.createElement("a");
        link.href = window.URL.createObjectURL(blob);
        var timestamp = new Date().toISOString().replace(/[-:.]/g, "");
        link.download = "recipe_data_"+timestamp+".csv";
        link.style.display = "none";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

</script>
</body>
</html>

<?php


?>