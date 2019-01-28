

$(function() {
    
    
    
    $('#search').autocomplete({
    
        source : liste,
        minLength : 2,
        max:10,

    });


    $('#search-field').autocomplete({
    
        source : liste,
        minLength : 2,
        max:10,

    });
});

