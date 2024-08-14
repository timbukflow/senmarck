$(document).ready(function() {

    // Nav fadin fadout on scroll
    const nav = document.querySelector('nav');
    let lastScrollTop = 0;
    const navShowThreshold = 100;

    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop + navShowThreshold) {
        nav.style.top = '-140px';
        lastScrollTop = scrollTop;
        } else if (scrollTop < lastScrollTop - navShowThreshold) {
        nav.style.top = '0';
        lastScrollTop = scrollTop;
        }
    });

    function toggleMenu() {
        $('#navburger').stop(true).toggleClass('open');
        $('.navcontainer').stop(true).slideToggle(300);
        $('body').toggleClass('scroll-lock');
    }
    
    function scrollToTarget(targetElement) {
        $('html, body').animate({
            scrollTop: targetElement.offset().top
        }, 800);
    }
    
    $('#navburger').click(toggleMenu);
    
    $('.scroll-link').click(function(e) {
        e.preventDefault();
        var targetId = $(this).data("target");
        var targetElement = $("#" + targetId);
        scrollToTarget(targetElement);
    
        if ($(window).width() <= 900) {
            toggleMenu(); // Collapse menu and enable scrolling
        }
    });
    
    
    // Home Image Fade-In-Out
    setInterval(function() {
        $('#overlay-picture').fadeOut(5000, function() {
            $(this).fadeIn(5000);
        });
    });

    // Plus Button Text
    $('.plus-button').click(function() {
      const button = $(this);
      const target = $(button.data('target'));
      const plusIcon = button.find('span'); 
    
      target.slideToggle(700, function() {
        plusIcon.toggleClass('rotate');
      });
    });

    // More Button
    $('.toggleButton').click(function() {
        const button = $(this);
        const morecontainer = button.prev('.more-container');
        const moreText = button.data('more-text');
        const lessText = button.data('less-text');
    
        morecontainer.slideToggle(500, function() {
          if (morecontainer.is(':visible')) {
            button.text(lessText);
          } else {
            button.text(moreText);
          }
        });
      });

      // energiespeichersystem
        let interval;
        let isDayMode = true;

        function getRandomNumberInRange(min, max) {
            return (Math.random() * (max - min) + min).toFixed(2);
        }

        function updateNumbers() {
            $('.animated-number').each(function() {
                const range = $(this).data(isDayMode ? 'range-day' : 'range-night').split('-');
                const min = parseFloat(range[0]);
                const max = parseFloat(range[1]);
                const newNumber = getRandomNumberInRange(min, max);
                
                $(this).contents().first()[0].textContent = `${newNumber} `;
            });
        }

        interval = setInterval(updateNumbers, 600);

        $('#daynightbtn').on('click', function() {
            isDayMode = !isDayMode;
            $('body').toggleClass('night-mode', !isDayMode);
            $('body').toggleClass('day-mode', isDayMode);
            $(this).html(`<span class="material-symbols-outlined">${isDayMode ? 'light_mode' : 'brightness_3'}</span>`);
            
            clearInterval(interval);
            updateNumbers();
            interval = setInterval(updateNumbers, 2000);
        });

        $('.energysystem').addClass('day-mode');

        //  Accordion
        $(".accordion h3").click(function() {
            // Close all panels
            $(".panel").not($(this).next()).slideUp();
            $(".accordion .arrow").not($(this).find(".arrow")).removeClass("spin");
    
            // Toggle the current panel
            $(this).next(".panel").slideToggle();
    
            // Rotate the arrow
            $(this).find(".arrow").toggleClass("spin");
        });
    
        $("#toggle-questions").click(function() {
            var hiddenAccordions = $(".hidden-accordions");
            if (hiddenAccordions.is(":visible")) {
                hiddenAccordions.slideUp();
                $(this).text("Alle Fragen Entdecken!");
            } else {
                hiddenAccordions.slideDown();
                $(this).text("Weniger Fragen Zeigen");
            }
        });
        
        // Handhabung von Dokument-Links
        $('.doc-link').on('click', function(e) {
            e.preventDefault();
            var docUrl = $(this).attr('href');
            $('#popup-iframe').attr('src', docUrl);
            $('#popup').css('display', 'flex');
        });

        // Schließen des Popups
        $('.popup').on('click', function() {
            $('#popup').css('display', 'none');
            $('#popup-iframe').attr('src', '');
        });
});
