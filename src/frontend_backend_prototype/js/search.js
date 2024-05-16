$(document).ready(function(){
    $("#searchBar").on("keyup", function() {
            var search = $(this).val();
            console.log(search); // Přidejte tento řádek
            if (search != '')
            {
                $.ajax({
                    url: 'php/search.php',
                    method: 'POST',
                    data: {searchBar:search},
                    success: function(data) {
                        $('#output').html(data);
                    }
                });
            } 
            else 
            {
                $('#output').html('');
            }
        });
    });

$(document).ready(function() {
    $("#search").submit(function(event) {
        var search = $("#searchBar").val();
        event.preventDefault(); 

        console.log("Form Data:");
        console.log("userInput:", search);

        cards_sort("textInput",search)

    
        
    });
});


$(document).ready(function(){
    var curentSearch = sessionStorage.getItem('search');

    if (curentSearch) {
        cards_sort(curentSearch);
    } else {
        cards_sort("");
    }  
    cards_sort(""); 
    
});

function cards_sort(sorting_method = sessionStorage.getItem('search'),searchPhrase = null){
    sessionStorage.setItem('search', sorting_method);
    console.log("sorting method ",sorting_method);  
    console.log("search phrase ", )
    $.ajax({
        url: 'php/insert_post.php',
        type: 'POST',
        data: {sort: sorting_method, searchPhrase: searchPhrase},
        success: function(response){
            //console.log(response);
            $('#result').html(response);
            checkLogin(delButtonsSetup);
        },
        error: function(xhr, status, error){
            console.error('AJAX Error:', status, error);
        }
    });
}

//dynamické určení velikosti barokní krásy - kurpoletního ideálu krásy
var horizontalniObdarovanost = document.getElementById("second");
var style = window.getComputedStyle(horizontalniObdarovanost);
var sirka = style.getPropertyValue("width");
var defaultValue = parseInt(sirka, 10);
console.log(defaultValue);
var rightValue = defaultValue - (defaultValue % 335) - 35;
console.log(rightValue);
horizontalniObdarovanost.style.width = rightValue + "px";