(function () {

    'use strict';

    function initMetisMenu() {
        // MetisMenu js
        document.addEventListener("DOMContentLoaded", function (event) {
            if(document.getElementById("side-menu"))
                new MetisMenu('#side-menu');
        }); 
    }

    function initCounterNumber() {

        var counter = document.querySelectorAll('.counter-value');
        var speed = 250; // The lower the slower
        counter && counter.forEach(function (counter_value) {
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

        window.onload = function () {

            if (window.innerWidth >= 1024 && window.innerWidth <= 1366) {
                document.body.setAttribute('data-sidebar-size', 'sm');
                updateRadio('sidebar-size-small')
            }
        }

        var verticalButton = document.getElementsByClassName("vertical-menu-btn");

        for (var i = 0; i < verticalButton.length; i++) {
            
            (function (index) {
                verticalButton[index] && verticalButton[index].addEventListener('click', function (event) {
                    event.preventDefault();
                    document.body.classList.toggle('sidebar-enable');
                    if (window.innerWidth >= 992) {
                        if (currentSIdebarSize == null) {
                            (document.body.getAttribute('data-sidebar-size') == null || document.body.getAttribute('data-sidebar-size') == "lg") ? document.body.setAttribute('data-sidebar-size', 'sm') : document.body.setAttribute('data-sidebar-size', 'lg')
                        } else if (currentSIdebarSize == "md") {
                            (document.body.getAttribute('data-sidebar-size') == "md") ? document.body.setAttribute('data-sidebar-size', 'sm') : document.body.setAttribute('data-sidebar-size', 'md')
                        } else {
                            (document.body.getAttribute('data-sidebar-size') == "sm") ? document.body.setAttribute('data-sidebar-size', 'lg') : document.body.setAttribute('data-sidebar-size', 'sm')
                        }
                    } else {
                        initMenuItemScroll();
                    }
                });
            })(i);
        }
    }

    function initActiveMenu() {

        setTimeout(function() {
            // === following js will activate the menu in left side bar based on url ====
            var menuItems = document.querySelectorAll("#sidebar-menu a");
            menuItems && menuItems.forEach(function (item) {
                var pageUrl = window.location.href.split(/[?#]/)[0];

                if (item.href == pageUrl) {
                    item.classList.add("active");
                    var parent = item.parentElement;
                    if (parent && parent.id !== "side-menu") {
                        parent.classList.add("mm-active");
                        var parent2 = parent.parentElement; // ul .
                        if (parent2 && parent2.id !== "side-menu") {
                            parent2.classList.add("mm-show"); // ul tag
                            if(parent2.classList.contains('mm-collapsing')) {
                                console.log('has mm-collapsing')
                            }
                            var parent3 = parent2.parentElement; // li tag
                            if (parent3 && parent3.id !== "side-menu") {
                                parent3.classList.add("mm-active"); // li
                                var parent4 = parent3.parentElement; // ul
                                if (parent4 && parent4.id !== "side-menu") {
                                    parent4.classList.add("mm-show"); // ul
                                    var parent5 = parent4.parentElement;
                                    if (parent5 && parent5.id !== "side-menu") {
                                        parent5.classList.add("mm-active"); // li
                                    }
                                }
                            }
                        }
                    }
                }
            });
        }, 0)
    }

    function initMenuItemScroll() {
        setTimeout( function() {
            var sidebarMenu = document.getElementById("side-menu");
            if (sidebarMenu) {
                var activeMenu = sidebarMenu.querySelector(".mm-active .active");
                var offset = (activeMenu) ? activeMenu.offsetTop : 0;
                if (offset > 300) {
                    offset = offset - 100;
                    var verticalMenu = (document.getElementsByClassName("vertical-menu")) ? document.getElementsByClassName("vertical-menu")[0] : '';
                    if (verticalMenu && verticalMenu.querySelector(".simplebar-content-wrapper")) {
                        setTimeout( function() {
                            verticalMenu.querySelector(".simplebar-content-wrapper").scrollTop = offset;
                        }, 0);
                    }
                }
            }
        }, 0);
    }

    function initHoriMenuActive() {

        var navlist = document.querySelectorAll(".navbar-nav a");
        navlist && navlist.forEach(function (item) {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (item.href == pageUrl) {
                item.classList.add("active");
                var parent = item.parentElement;
                if (parent) {
                    parent.classList.add("active"); // li
                    var parent2 = parent.parentElement;
                    parent2.classList.add("active"); // li
                    var parent3 = parent2.parentElement;
                    if (parent3) {
                        parent3.classList.add("active"); // li
                        var parent4 = parent3.parentElement;
                        if (parent4) {
                            parent4.classList.add("active"); // li
                            var parent5 = parent4.parentElement;
                            if (parent5) {
                                parent5.classList.add("active"); // li
                                var parent6 = parent5.parentElement;
                                if (parent6) {
                                    parent6.classList.add("active"); // li
                                }
                            }
                        }
                    }
                }
            }
        });
    }

    function initFullScreen() {
        var fullscreenBtn = document.querySelector('[data-toggle="fullscreen"]');
        fullscreenBtn && fullscreenBtn.addEventListener('click', function (e) {
            e.preventDefault();
            document.body.classList.toggle('fullscreen-enable');
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
                document.body.classList.remove('fullscreen-enable');
            }
        }
    }

    function initDropdownMenu() {
        if (document.getElementById("topnav-menu-content")) {
            var elements = document.getElementById("topnav-menu-content").getElementsByTagName("a");
            for (var i = 0, len = elements.length; i < len; i++) {
                elements[i].onclick = function (elem) {
                    if (elem.target.getAttribute("href") === "#") {
                        elem.target.parentElement.classList.toggle("active");
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
            if (elements[i].parentElement.getAttribute("class") === "nav-item dropdown active") {
                elements[i].parentElement.classList.remove("active");
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

    function fadeOutEffect(elem, delay) {
        var fadeTarget = document.getElementById(elem);
        fadeTarget.style.display = 'block';
        var fadeEffect = setInterval(function () {
            if (!fadeTarget.style.opacity) {
                fadeTarget.style.opacity = 1;
            }
            if (fadeTarget.style.opacity > 0) {
                fadeTarget.style.opacity -= 0.2;
            } else {
                clearInterval(fadeEffect);
                fadeTarget.style.display = 'none';
            }
        }, 200);
    }

    function initPreloader() {
        window.onload = function () {
            if (document.getElementById("preloader")) {
                fadeOutEffect('pre-status', 300);
                fadeOutEffect('preloader', 400);
            }
        }
    }

    function initSettings() {
        // Feather Icons
        feather.replace();
        if (window.sessionStorage) {
            var alreadyVisited = sessionStorage.getItem("is_visited");
            if (!alreadyVisited) {
                sessionStorage.setItem("is_visited", "layout-direction-ltr");
            } else {
                var value = document.querySelector("#" + alreadyVisited);
                if (value !== null)
                {
                    value.checked = true;
                    changeDirection(alreadyVisited);
                }
            }
        }
    }

    function changeDirection(id) {
        if (document.getElementById("layout-direction-ltr").checked == true && id === "layout-direction-ltr") {
            document.getElementsByTagName("html")[0].removeAttribute("dir");
            document.getElementById("layout-direction-rtl").checked = false;
            document.getElementById('bootstrap-style').setAttribute('href', 'assets/css/bootstrap.min.css');
            document.getElementById('app-style').setAttribute('href', 'assets/css/app.min.css');
            sessionStorage.setItem("is_visited", "layout-direction-ltr");
        } else if (document.getElementById("layout-direction-rtl").checked == true && id === "layout-direction-rtl") {
            document.getElementById("layout-direction-ltr").checked = false;
            document.getElementById('bootstrap-style').setAttribute('href', 'assets/css/bootstrap-rtl.min.css');
            document.getElementById('app-style').setAttribute('href', 'assets/css/app-rtl.min.css');
            document.getElementsByTagName("html")[0].setAttribute("dir", "rtl");
            sessionStorage.setItem("is_visited", "layout-direction-rtl");
        }
    }


    function updateRadio(radioId) {
        if (document.getElementById(radioId))
            document.getElementById(radioId).checked = true;
    }

    function initCheckAll() {
        var checkAll = document.getElementById("checkAll");
        if (checkAll) {
            checkAll.onclick = function() {
                var checkboxes = document.querySelectorAll('.table-check input[type="checkbox"]');
                for(var i=0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = this.checked;
                }
            }
        }
    }

    function init() {
        initPreloader();
        initSettings();
        initMetisMenu();
        initCounterNumber();
        initLeftMenuCollapse();
        initActiveMenu();
        initHoriMenuActive();
        initFullScreen();
        initDropdownMenu();
        initComponents();
        initMenuItemScroll();
        initCheckAll();
    }

    init();

})();



