self.addEventListener("install", function(event) {
    console.log('WORKER: install event in progress.');
    event.waitUntil(
      caches.open('trans-2')
            .then(function(cache) {
                return cache.addAll([
                    './',
                    './css/master.css',
                    './js/master.js',
                    './fonts/proximanovalight.ttf',
                    './fonts/MYRIADPROREGULAR.ttf',
                    './images/bg.jpg',
                    './service-worker.js',
                    './trains.php'
                ]);
            })
            .then(function() {
                console.log('WORKER: install completed');
            })
    );
});
self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request)
            .then(function(response) {
                    if (response) {
                        return response;
                    }

                    return fetch(event.request);
                }
            )
    );
});