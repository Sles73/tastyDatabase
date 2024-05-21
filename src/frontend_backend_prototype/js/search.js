$(document).ready(function() {
    $("#searchBar").on("keyup", handleKeyUp);
});

function handleKeyUp() {
    var search = $("#searchBar").val();
    cards_sort("textInput", search);
    console.log(search); // Přidejte tento řádek
    if (search != '') {
        performSearch(search);
    } else {
        $('#output').html('');
    }
}

function performSearch(search) {
    $.ajax({
        url: 'php/search.php',
        method: 'POST',
        data: { searchBar: search },
        success: function(data) {
            $('#output').html(data);

            const clickableElements = document.querySelectorAll('.searchResult');
            console.log(clickableElements);
            clickableElements.forEach(element => {
                element.addEventListener('click', event => {
                    console.log(event.target.innerHTML);
                    document.getElementById("searchBar").value = event.target.innerHTML;
                    handleKeyUp();

                });
            });
        }
    });
}

$(document).ready(function() {
    $("#search").submit(function(event) {
        var search = $("#searchBar").val();
        event.preventDefault(); 

        cards_sort("textInput",search)
    });
});

$(document).ready(function() {
    $("#clear").click(function() {
        cards_sort("");
        $("#searchBar").val('');
        handleKeyUp();
    });
});


$(document).ready(function(){
    var curentSearch = sessionStorage.getItem('search');

    if (curentSearch) {
        cards_sort(curentSearch);
    } else {
        cards_sort("");
    }  
    
});

function cards_sort(sorting_method = sessionStorage.getItem('search'),searchPhrase = null){
    sessionStorage.setItem('search', sorting_method);
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
