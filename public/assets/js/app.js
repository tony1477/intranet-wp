/*
Template Name: Minia - Bootstrap 5 Admin & Dashboard Template
Author: Themesbrand
Version: 1.1.0
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Main Js File
*/


(function ($) {

    'use strict';

    var language = localStorage.getItem('minia-language');
    // Default Language
    var default_lang = 'en';

    var layout_mode = localStorage.getItem('layout-mode');
    var default_mode = 'light';

    function setLanguage(lang) {
        if (document.getElementById("header-lang-img")) {
            if (lang == 'en') {
                document.getElementById("header-lang-img").src = "assets/images/flags/us.jpg";
            } else if (lang == 'sp') {
                document.getElementById("header-lang-img").src = "assets/images/flags/spain.jpg";
            } else if (lang == 'gr') {
                document.getElementById("header-lang-img").src = "assets/images/flags/germany.jpg";
            } else if (lang == 'it') {
                document.getElementById("header-lang-img").src = "assets/images/flags/italy.jpg";
            } else if (lang == 'ru') {
                document.getElementById("header-lang-img").src = "assets/images/flags/russia.jpg";
            }
            localStorage.setItem('minia-language', lang);
            language = localStorage.getItem('minia-language');
            getLanguage();
        }
    }

    // Multi language setting
    function getLanguage() {
        (language == null) ? setLanguage(default_lang) : false;
        $.getJSON('assets/lang/' + language + '.json', function (lang) {
            $('html').attr('lang', language);
            $.each(lang, function (index, val) {
                (index === 'head') ? $(document).attr("title", val['title']) : false;
                $("[data-key='" + index + "']").text(val);
            });
        });
    }

    function initMetisMenu() {
        //metis menu
        $("#side-menu").metisMenu();
    }

    function initCounterNumber() {
        var counter = document.querySelectorAll('.counter-value');
        var speed = 250; // The lower the slower
        counter.forEach(function (counter_value) {
            function updateCount() {
                var target = +counter_value.getAttribute('data-target');
                var count = +counter_value.innerText;
                var inc = target / speed;
                if (inc < 1) {
                    inc = 1;
                }
                // Check if target is reached
                if (count < target) {
                    // Add inc to count and output in counter_value
                    counter_value.innerText = (count + inc).toFixed(0);
                    // Call function every ms
                    setTimeout(updateCount, 1);
                } else {
                    counter_value.innerText = target;
                }
            };
            updateCount();
        });
    }

    function initLeftMenuCollapse() {
        var currentSIdebarSize = document.body.getAttribute('data-sidebar-size');
        $(window).on('load', function () {

            $('.switch').on('switch-change', function () {
                toggleWeather();
            });

            if (window.innerWidth >= 1024 && window.innerWidth <= 1366) {
                document.body.setAttribute('data-sidebar-size', 'sm');
                updateRadio('sidebar-size-small')
            }
        });

        $('#vertical-menu-btn').on('click', function (event) {
            event.preventDefault();
            $('body').toggleClass('sidebar-enable');
            if ($(window).width() >= 992) {
                if (currentSIdebarSize == null) {
                    (document.body.getAttribute('data-sidebar-size') == null || document.body.getAttribute('data-sidebar-size') == "lg") ? document.body.setAttribute('data-sidebar-size', 'sm') : document.body.setAttribute('data-sidebar-size', 'lg')
                } else if (currentSIdebarSize == "md") {
                    (document.body.getAttribute('data-sidebar-size') == "md") ? document.body.setAttribute('data-sidebar-size', 'sm') : document.body.setAttribute('data-sidebar-size', 'md')
                } else {
                    (document.body.getAttribute('data-sidebar-size') == "sm") ? document.body.setAttribute('data-sidebar-size', 'lg') : document.body.setAttribute('data-sidebar-size', 'sm')
                }
            }
        });
    }

    function initActiveMenu() {
        // === following js will activate the menu in left side bar based on url ====
        $("#sidebar-menu a").each(function () {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().addClass("mm-active"); // add active to li of the current link
                $(this).parent().parent().addClass("mm-show");
                $(this).parent().parent().prev().addClass("mm-active"); // add active class to an anchor
                $(this).parent().parent().parent().addClass("mm-active");
                $(this).parent().parent().parent().parent().addClass("mm-show"); // add active to li of the current link
                $(this).parent().parent().parent().parent().parent().addClass("mm-active");
            }
        });
    }

    function initMenuItemScroll() {
        // focus active menu in left sidebar
        $(document).ready(function () {
            if ($("#sidebar-menu").length > 0 && $("#sidebar-menu .mm-active .active").length > 0) {
                var activeMenu = $("#sidebar-menu .mm-active .active").offset().top;
                console.log("activeMenu", activeMenu)
                if (activeMenu > 300) {
                    activeMenu = activeMenu - 300;
                    $(".vertical-menu .simplebar-content-wrapper").animate({
                        scrollTop: activeMenu
                    }, "slow");
                }
            }
        });
    }

    function initHoriMenuActive() {
        $(".navbar-nav a").each(function () {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().addClass("active");
                $(this).parent().parent().addClass("active");
                $(this).parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().parent().parent().addClass("active");
            }
        });
    }

    function initFullScreen() {
        $('[data-toggle="fullscreen"]').on("click", function (e) {
            e.preventDefault();
            $('body').toggleClass('fullscreen-enable');
            if (!document.fullscreenElement && /* alternative standard method */ !document.mozFullScreenElement && !document.webkitFullscreenElement) { // current working methods
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                }
            }
        });
        document.addEventListener('fullscreenchange', exitHandler);
        document.addEventListener("webkitfullscreenchange", exitHandler);
        document.addEventListener("mozfullscreenchange", exitHandler);

        function exitHandler() {
            if (!document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement) {
                $('body').removeClass('fullscreen-enable');
            }
        }
    }

    function initDropdownMenu() {
        if (document.getElementById("topnav-menu-content")) {
            var elements = document.getElementById("topnav-menu-content").getElementsByTagName("a");
            for (var i = 0, len = elements.length; i < len; i++) {
                elements[i].onclick = function (elem) {
                    if (elem && elem.target && elem.target.getAttribute("href") === "#") {
                        elem.target.parentElement.classList.toggle("active");
                        if (elem.target.nextElementSibling)
                            elem.target.nextElementSibling.classList.toggle("show");
                    }
                }
            }
            window.addEventListener("resize", updateMenu);
        }
    }

    function updateMenu() {
        var elements = document.getElementById("topnav-menu-content").getElementsByTagName("a");
        for (var i = 0, len = elements.length; i < len; i++) {
            if (elements[i] && elements[i].parentElement && elements[i].parentElement.getAttribute("class") === "nav-item dropdown active") {
                elements[i].parentElement.classList.remove("active");
                if (elements[i].nextElementSibling)
                    elements[i].nextElementSibling.classList.remove("show");
            }
        }
    }

    function initComponents() {
        // tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // popover
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        });

        // toast
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl)
        })
    }

    function initPreloader() {
        $(window).on('load', function () {
            $('#status').fadeOut();
            $('#preloader').delay(350).fadeOut('slow');
        });
    }

    function initSettings() {
        if (window.sessionStorage) {
            var alreadyVisited = sessionStorage.getItem("is_visited");
            if (!alreadyVisited) {
                sessionStorage.setItem("is_visited", "layout-ltr");
            } else {
                $("#" + alreadyVisited).prop('checked', true);
                // changeDirection(alreadyVisited);
            }
        }
    }

    function initLanguage() {
        // Auto Loader
        console.log('init-lang')
        if (language && language != "null" && language !== default_lang)
            setLanguage(language);
        $('.language').on('click', function (e) {
            setLanguage($(this).attr('data-lang'));
        });
    }

    function initLayoutMode() {
        // Auto Loader
        if (layout_mode && layout_mode != "null" && layout_mode !== default_mode) {
            setLayoutMode(layout_mode);
        }
        $('#mode-setting-btn').on('click', function (e) {
            const layout = e.target.dataset.layout
            setLayoutMode(layout);
        });
    }

    function setLayoutMode(layout) {
        localStorage.setItem('layout-mode',layout)
        updateMode()
    }

    function initCheckAll() {
        $('#checkAll').on('change', function () {
            $('.table-check .form-check-input').prop('checked', $(this).prop("checked"));
        });
        $('.table-check .form-check-input').change(function () {
            if ($('.table-check .form-check-input:checked').length == $('.table-check .form-check-input').length) {
                $('#checkAll').prop('checked', true);
            } else {
                $('#checkAll').prop('checked', false);
            }
        });
    }

    function updateRadio(radioId) {
        // document.getElementById(radioId).checked = true;
        
    }

    function updateMode() {
        // return localStorage.getItem('layout-mode')
        // console.log(localStorage.getItem('layout-mode'))
        const layout = localStorage.getItem('layout-mode')
        const body = document.getElementsByTagName("body")[0]
        body.setAttribute('data-layout-mode',layout)
        body.setAttribute('data-topbar',layout)
        body.setAttribute('data-sidebar',layout)
    }
    function layoutSetting() {
        var body = document.getElementsByTagName("body")[0];
        // right side-bar toggle
        $('.right-bar-toggle').on('click', function (e) {
            $('body').toggleClass('right-bar-enabled');
        });

        $('#mode-setting-btn').on('click', function (e) {
            if (body.hasAttribute("data-layout-mode") && body.getAttribute("data-layout-mode") == "dark") {
                localStorage.setItem('layout-mode','light')
                document.body.setAttribute('data-layout-mode', updateMode());
                document.body.setAttribute('data-topbar', updateMode());
                document.body.setAttribute('data-sidebar', updateMode());
                (body.hasAttribute("data-layout") && body.getAttribute("data-layout") == "horizontal") ? '' : document.body.setAttribute('data-sidebar', 'light');
                updateRadio('topbar-color-light')
                updateRadio('sidebar-color-light')
                updateRadio('topbar-color-light')
            } else {
                localStorage.setItem('layout-mode','dark')
                document.body.setAttribute('data-layout-mode', updateMode());
                document.body.setAttribute('data-topbar', updateMode());
                document.body.setAttribute('data-sidebar', updateMode());
                (body.hasAttribute("data-layout") && body.getAttribute("data-layout") == "horizontal") ? '' : document.body.setAttribute('data-sidebar', 'dark');
                updateRadio('layout-mode-dark')
                updateRadio('sidebar-color-dark')
                updateRadio('topbar-color-dark')
            }
        });

        $(document).on('click', 'body', function (e) {
            if ($(e.target).closest('.right-bar-toggle, .right-bar').length > 0) {
                return;
            }
            $('body').removeClass('right-bar-enabled');
            return;
        });

        if (body.hasAttribute("data-layout") && body.getAttribute("data-layout") == "horizontal") {
            updateRadio('layout-horizontal');
            $(".sidebar-setting").hide();
        } else {
            updateRadio('layout-vertical');
        }
        (body.hasAttribute("data-layout-mode") && body.getAttribute("data-layout-mode") == "dark") ? updateRadio('layout-mode-dark') : updateRadio('layout-mode-light');
        (body.hasAttribute("data-layout-size") && body.getAttribute("data-layout-size") == "boxed") ? updateRadio('layout-width-boxed') : updateRadio('layout-width-fuild');
        (body.hasAttribute("data-layout-scrollable") && body.getAttribute("data-layout-scrollable") == "true") ? updateRadio('layout-position-scrollable') : updateRadio('layout-position-fixed');
        (body.hasAttribute("data-topbar") && body.getAttribute("data-topbar") == "dark") ? updateRadio('topbar-color-dark') : updateRadio('topbar-color-light');
        (body.hasAttribute("data-sidebar-size") && body.getAttribute("data-sidebar-size") == "sm") ? updateRadio('sidebar-size-small') : (body.hasAttribute("data-sidebar-size") && body.getAttribute("data-sidebar-size") == "md") ? updateRadio('sidebar-size-compact') : updateRadio('sidebar-size-default');
        (body.hasAttribute("data-sidebar") && body.getAttribute("data-sidebar") == "brand") ? updateRadio('sidebar-color-brand') : (body.hasAttribute("data-sidebar") && body.getAttribute("data-sidebar") == "dark") ? updateRadio('sidebar-color-dark') : updateRadio('sidebar-color-light');
        (document.getElementsByTagName("html")[0].hasAttribute("dir") && document.getElementsByTagName("html")[0].getAttribute("dir") == "rtl") ? updateRadio('layout-direction-rtl') : updateRadio('layout-direction-ltr');

        // on layou change
        $("input[name='layout']").on('change', function () {
            window.location.href = ($(this).val() == "vertical") ? "index.html" : "layouts-horizontal.html";
        });

        // on layout mode change
        $("input[name='layout-mode']").on('change', function () {
            if ($(this).val() == "light") {
                document.body.setAttribute('data-layout-mode', updateMode());
                document.body.setAttribute('data-topbar', updateMode());
                document.body.setAttribute('data-sidebar', updateMode());
                (body.hasAttribute("data-layout") && body.getAttribute("data-layout") == "horizontal") ? '' : document.body.setAttribute('data-sidebar', updateMode());
                updateRadio('topbar-color-light')
                updateRadio('sidebar-color-light')
            } else {
                document.body.setAttribute('data-layout-mode', updateMode());
                document.body.setAttribute('data-topbar', updateMode());
                document.body.setAttribute('data-sidebar', updateMode());
                (body.hasAttribute("data-layout") && body.getAttribute("data-layout") == "horizontal") ? '' : document.body.setAttribute('data-sidebar', updateMode());
                updateRadio('topbar-color-dark')
                updateRadio('sidebar-color-dark')
            }
        });

        // on RTL-LTR mode change
        $("input[name='layout-direction']").on('change', function () {
            if ($(this).val() == "ltr") {
                document.getElementsByTagName("html")[0].removeAttribute("dir");
                document.getElementById('bootstrap-style').setAttribute('href', 'assets/css/bootstrap.min.css');
                document.getElementById('app-style').setAttribute('href', 'assets/css/app.min.css');
            } else {
                document.getElementById('bootstrap-style').setAttribute('href', 'assets/css/bootstrap-rtl.min.css');
                document.getElementById('app-style').setAttribute('href', 'assets/css/app-rtl.min.css');
                document.getElementsByTagName("html")[0].setAttribute("dir", "rtl");
            }
        });
    }

    const cobafunc = () => {
        console.log('ada')
        // Pusher.logToConsole = true;
        const pusher = new Pusher('5484a2d917d249565526', {
            cluster: 'ap1',
            encrypted: true
        });
        
        const channel = pusher.subscribe('my-channel');
        
        channel.bind('new-notifications', (data) => {
            // Handle the new notification event
            const notifContainer = document.querySelector('.simplebar-content');
            const notifNumber = document.querySelector('.notif-number');
            data.data.forEach((row) => {
                const el = document.createElement('a')
                el.className = 'text-reset notification-item'
                el.innerHTML = `<div class="d-flex">
                <div class="flex-shrink-0 me-3">
                    <img src="public/assets/images/users/${row.img}" class="rounded-circle avatar-sm" alt="user-pic">
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-1">${row.title}</h6>
                    <div class="font-size-13 text-muted">
                        <p class="mb-1">${row.content}</p>
                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>${row.date}</span></p>
                    </div>
                </div>
            </div>`
            notifContainer.appendChild(el)
            })
            notifNumber.innerHTML = data.number 
            alertify.set('notifier','position', 'top-right');
            alertify.success('Current position : ' + alertify.get('notifier','position'));
            // Update the user interface to show the new notification
        });
    }

    function init() {
        initMetisMenu();
        initCounterNumber();
        initLeftMenuCollapse();
        initActiveMenu();
        initMenuItemScroll();
        initHoriMenuActive();
        initFullScreen();
        initDropdownMenu();
        initComponents();
        initSettings();
        initLayoutMode();
        initLanguage();
        initPreloader();
        layoutSetting();
        Waves.init();
        initCheckAll();
        cobafunc();
    }

    init();

})(jQuery)


feather.replace()

$('#mode-setting-btn').on('click',function(e){
    const layout = e.target.dataset.layout
    localStorage.setItem('layout-mode',layout)
    const body = document.getElementsByTagName("body")[0]
    body.setAttribute('data-layout-mode',layout)
    body.setAttribute('data-topbar',layout)
    body.setAttribute('data-sidebar',layout)
})