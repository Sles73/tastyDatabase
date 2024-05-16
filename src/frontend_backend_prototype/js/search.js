$(document).ready(function(){
    var curentSearch = sessionStorage.getItem('search');

    if (curentSearch) {
        cards_sort(curentSearch);
    } else {
        cards_sort("");
    }   
    
});

function cards_sort(sorting_method = sessionStorage.getItem('search')){
    sessionStorage.setItem('search', sorting_method);
    $.ajax({
        url: 'php/insert_post.php',
        type: 'POST',
        data: {sort: sorting_method},
        success: function(response){
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