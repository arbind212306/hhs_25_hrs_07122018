var navbar =
    "<nav class='navbar navbar-default'>" +
        "<div class='container-fluid'>" +
            "<div class='navbar-header'>" +
                "<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar_dropdown' aria-expanded='false'>" +
                    "<span class='sr-only'>Toggle navigation</span>" +
                    "<span class='icon-bar'></span>" +
                    "<span class='icon-bar'></span>" +
                    "<span class='icon-bar'></span>" +
                "</button>" +
                "<a class='navbar-brand navbar-brand-image' href='dashboard.html'></a>" +
            "</div>" +
            "<div class='collapse navbar-collapse' id='navbar_dropdown'>" +
                "<ul class='nav navbar-nav navbar-right'>" +
                    "<li><a href='dashboard.html'>Dashboard</a></li>" +
                    "<li><a href='indent.html'>Indent</a></li>" +
                    "<li><a href='clients.html'>Clients</a></li>" +
                    "<li><a href='client-position.html'>Client Positions</a></li>" +
                    "<li><a href='candidates.html'>Candidates</a></li>" +
                    "<li class='dropdown'>" +
                        "<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Hello, Ram <span class='caret'></span></a>" +
                        "<ul class='dropdown-menu'>" +
                            "<li>" +
                                "<label class='padding-md margin-bottom-0' style='padding-bottom: 10px; padding-top: 10px'>" +
                                    "<small>Switch User</small>" +
                                "</label>" +
                            "</li>" +
                            "<li class='active'><a href='change-password.html'>Head</a></li>" +
                            "<li><a href='change-password.html'>Recruiter</a></li>" +
                            "<li role='separator' class='divider'></li>" +
                            "<li><a href='change-password.html'>Change Password</a></li>" +
                            "<li><a href='index.html'>Logout</a></li>" +
                        "</ul>" +
                    "</li>" +
                "</ul>" +
            "</div>" +
        "</div>" +
    "</nav>",

    recruiterNavbar =
        "<nav class='navbar navbar-default'>" +
        "<div class='container-fluid'>" +
        "<div class='navbar-header'>" +
        "<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar_dropdown' aria-expanded='false'>" +
        "<span class='sr-only'>Toggle navigation</span>" +
        "<span class='icon-bar'></span>" +
        "<span class='icon-bar'></span>" +
        "<span class='icon-bar'></span>" +
        "</button>" +
        "<a class='navbar-brand navbar-brand-image' href='dashboard.html'></a>" +
        "</div>" +
        "<div class='collapse navbar-collapse' id='navbar_dropdown'>" +
        "<ul class='nav navbar-nav navbar-right'>" +
        "<li><a href='dashboard.html'>Dashboard</a></li>" +
        "<li><a href='indent.html'>Indent</a></li>" +
        "<li><a href='candidates.html'>Candidates</a></li>" +
        "<li><a href='talent-pool.html'>Talent Pool</a></li>" +
        "<li class='dropdown'>" +
        "<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Hello, Ram <span class='caret'></span></a>" +
        "<ul class='dropdown-menu'>" +
        "<li>" +
        "<label class='padding-md margin-bottom-0' style='padding-bottom: 10px; padding-top: 10px'>" +
        "<small>Switch User</small>" +
        "</label>" +
        "</li>" +
        "<li class='active'><a href='change-password.html'>Head</a></li>" +
        "<li><a href='change-password.html'>Recruiter</a></li>" +
        "<li role='separator' class='divider'></li>" +
        "<li><a href='change-password.html'>Change Password</a></li>" +
        "<li><a href='index.html'>Logout</a></li>" +
        "</ul>" +
        "</li>" +
        "</ul>" +
        "</div>" +
        "</div>" +
        "</nav>",

    url = $(location).attr('href'),
    parts = url.split("/"),
    last_part = parts[parts.length - 1];

function setNavbarActive() {
    $("#navbar").html(navbar).promise().done(function () {
        $("#navbar").find(".navbar-nav li").each(function () {
            if($(this).find("a").attr("href") === last_part) {
                $(this).addClass("active");
            }
        });
    });

    $("#recruiter_navbar").html(recruiterNavbar).promise().done(function () {
        $("#recruiter_navbar").find(".navbar-nav li").each(function () {
            if($(this).find("a").attr("href") === last_part) {
                $(this).addClass("active");
            }
        });
    });
}

$(document).ready(function () {
    setNavbarActive();
});

$(window).on("load",function () {

    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
                backgroundColor: [
                    "rgb(255, 99, 132)",
                    "rgb(255, 159, 64)",
                    "rgb(255, 205, 86)",
                    "rgb(75, 192, 192)",
                    "rgb(54, 162, 235)"
                ],
                label: 'Dataset 1'
            }],
            labels: [
                'Red',
                'Orange',
                'Yellow',
                'Green',
                'Blue'
            ]
        },
        options: {
            responsive: true
        }
    };

    window.onload = function() {
        var ctx = document.getElementById('chart-area').getContext('2d');
        window.myPie = new Chart(ctx, config);
    };

    $(document).on('click', '#navbar .dropdown-menu', function (e) {
        e.stopPropagation();
    });

});