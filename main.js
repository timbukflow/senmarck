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

    // nav burgericon
    $('#navburger').click(function(){
        $(this).stop(true).toggleClass('open');
        $('.navcontainer').stop(true).slideToggle(300);
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
            $('.energysystem').toggleClass('night-mode', !isDayMode);
            $('.energysystem').toggleClass('day-mode', isDayMode);
            $(this).html(`<span class="material-symbols-outlined">${isDayMode ? 'light_mode' : 'brightness_3'}</span>`);
            
            clearInterval(interval);
            updateNumbers();
            interval = setInterval(updateNumbers, 2000);
        });

        $('.energysystem').addClass('day-mode');
    

    
      

    // Handhabung von Dokument-Links
    $('.doc-link').on('click', function(e) {
        e.preventDefault();
        var docUrl = $(this).attr('href');
        $('#popup-iframe').attr('src', docUrl);
        $('#popup').css('display', 'flex');
    });

    // Schließen des Popups
    $('.close-btn').on('click', function() {
        $('#popup').css('display', 'none');
        $('#popup-iframe').attr('src', '');
    });

    // Akkordeon-Logik
    $(".accordion").click(function() {
        $(this).toggleClass("active");
        var panel = $(this).next(".panel");
        if (panel.css("max-height") === "0px") {
            panel.css("max-height", panel.prop("scrollHeight") + "px");
        } else {
            panel.css("max-height", "0px");
        }
    });
});
