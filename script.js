$(document).ready(function() {
    
    loadCategoryData();
    loadRecipeData();

    // Intercept the form submission
    $('#recipeForm').submit(function(e) {
        e.preventDefault();

        // Get form data
        var formData = {
            name: $('#name').val(),
            category: $('#category').val(),
            rangeFrom: $("#rangeFrom").val(),
            rangeTo: $("#rangeTo").val()
        };

        addRecipeData(formData);
    });

    function loadCategoryData(){
        // Ajax request to get category data
        $.ajax({
            url: 'getCategoryData.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Populate the select box with the retrieved data
                var selectBox = $('#category');

                $.each(data, function(index, item) {
                    selectBox.append('<option value="' + item.category_id + '">' + item.category_name + '</option>');
                });
            },
            error: function(error) {
                console.log('Error: ', error);
            }
        });
    }

    function loadRecipeData(){
        // Ajax request to get recipe data
        $.ajax({
            url: 'getRecipeData.php',
            type: 'POST',
            cache: false,
            dataType: 'json',
            success: function(response) {
                // Populate the HTML table with the retrieved data
                var tableBody = $('#recipeTable tbody');
                // $('#recipeTable').empty();
                $.each(response, function(index, item) {
                    var row = '<tr>' +
                        // '<td>' + item.recipe_id + '</td>' +
                        '<td>' + item.recipe_name + '</td>' +
                        '<td>' + item.category_name + '</td>' +
                        '<td>' + item.range_from + '</td>' +
                        '<td>' + item.range_to + '</td>' +
                        '</tr>';
                    tableBody.append(row);
                });
            },
            error: function(error) {
                console.log('Error: ', error);
            }
        });
    }

    function addRecipeData(formData){
        // Ajax request to submit form data
        $.ajax({
            url: 'addRecipe.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                $('#recipeTable tbody').empty();
                $('#recipeForm')[0].reset();
                loadRecipeData();
            },
            error: function(error) {
                // Handle the error response here
                console.log('Error: ', error);
            }
        });
    }



});
