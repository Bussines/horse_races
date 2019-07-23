$("#create-race-btn").on('click', function(event){
    $.ajax({
        url: '/raceHorse/create',
        type: "POST",
        dataType: "json",
        success : function(data) {
            if (data) {
                window.location='/raceHorse/list';
            }
        }
    });
});

$("#progress-races-btn").on('click', function(event){
    $.ajax({
        url: '/raceHorse/progress',
        type: "POST",
        dataType: "json",
        success : function(data) {
            if (data) {
                window.location='/raceHorse/list';
            }
        }
    });
});