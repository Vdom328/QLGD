var SK = (function() {
    "use strict"

    /**
     * Calculate age from date
     */
    function calc_age(birthDateStr) {
        // Validate the input date
        if (birthDateStr === '') {
            console.log('Please enter a valid birth date');
            return;
        }
    
        var birthDate = new Date(birthDateStr);
        var currentDate = new Date();
    
        // Calculate the difference in years
        var age = currentDate.getFullYear() - birthDate.getFullYear();
    
        // Check if the birthday hasn't occurred yet this year
        if (currentDate.getMonth() < birthDate.getMonth() ||
            (currentDate.getMonth() === birthDate.getMonth() && currentDate.getDate() < birthDate.getDate())) {
            age--;
        }
    
        return age;
    };

    function clearCache() {
        if (navigator.onLine == true && typeof caches != undefined && typeof caches != 'undefined') {
            var staticCacheName = "pwa-v" + new Date().getTime();
            caches.keys().then(cacheNames => {
                return Promise.all(
                    cacheNames
                        .filter(cacheName => (cacheName.startsWith("pwa-")))
                        .filter(cacheName => (cacheName !== staticCacheName))
                        .map(cacheName => caches.delete(cacheName))
                );
            })
        }
    }
    
    function addCache() {
        if (navigator.onLine == true && typeof caches != undefined && typeof caches != 'undefined') {
            var staticCacheName = "pwa-v" + new Date().getTime();
            var filesToCache = [
                '/',
                '/offline',
                '/home',
                '/staffs-calendar',
                '/control/staffs-operation',
                '/company-project',
                '/monthly-calendar',
                '/daily-sales-summary',
                '/projects',
                '/attendance',
                '/transportation-expense',
                '/allowances',
                '/companies',
                '/staffs',
                '/users',
                
                '/build/assets/app-c50d9ca6.css',
                '/assets/css/aims.css',
                '/build/assets/control-03dc0f48.css',
                '/build/assets/assign_staff-fdeb2f8a.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
                'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css',
                '/images/icons/icon-192x192.png',
                '/images/icons/icon-512x512.png',
                '/images/icons/splash-640x1136.png',
                '/images/icons/splash-750x1334.png',
                '/images/icons/splash-1242x2208.png',
                '/images/icons/splash-1125x2436.png',
                '/images/icons/splash-828x1792.png',
                '/images/icons/splash-1242x2688.png',
                '/images/icons/splash-1536x2048.png',
                '/images/icons/splash-1668x2224.png',
                '/images/icons/splash-1668x2388.png',
                '/images/icons/splash-2048x2732.png',
                '/assets/images/thefarm-logo.png',
                '/assets/images/icons/logout.png',
                '/assets/images/icons/bxs-dashboard.png',
                '/assets/images/icons/calendar.png',
                '/assets/images/icons/clipboard-data.png',
                '/assets/images/icons/chart-line-data.png',
                '/assets/images/icons/notes.png',
                '/assets/images/icons/view-week.png',
                '/assets/images/icons/note-solid.png',
                '/assets/images/icons/ios-paper.png',
                '/assets/images/icons/train.png',
                '/assets/images/icons/piggy-bank-solid.png',
                '/assets/images/icons/building.png',
                '/assets/images/icons/group.png',
                '/assets/images/icons/administrator-solid.png',
            
                '/build/assets/app-f2d28d29.js',
                '/build/assets/jquery-43a0b7d5.js',
                '/assets/js/common.js?v=6',
                'https://code.jquery.com/jquery-3.6.0.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js',
                'https://cdn.socket.io/4.5.4/socket.io.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
            
                '/manifest.json',
            ];
            caches.open(staticCacheName)
                .then(cache => {
                    return cache.addAll(filesToCache);
                })
        }
    }


    // Public methods
    var publicMethods = {
        calcAge: function(birthDateStr) {
            return calc_age(birthDateStr);
        },
        clearCache: function() {
            return clearCache();
        },
        addCache: function(birthDateStr) {
            return addCache(birthDateStr);
        }
    };
    return publicMethods;

})();

SK.clearCache();
SK.addCache();  

$(function() {
    $(document).on('click', '.rowlink', function(e) {
        if (e.target.tagName == 'A') { // check element is a tag?
            return;
        }
        var url = $(this).data('action');
        if (url) {
            window.location.href = url;
        }
    })
});

/**
 * Wrapper ajax request
 * @param {*} url 
 * @param {*} data 
 * @param {*} successFunction 
 */
function myAjaxCall(type, url, data, successFunction) {
    $.ajax({
        url: url,
        type: type,
        data: data,
        success: function(response) {
            successFunction(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}


  