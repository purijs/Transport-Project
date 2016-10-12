"use strict";
var version = 'v1-';
var offlineTrains = [
    './',
    './css/master.css',
    './js/master.js',
    './fonts/proximanovalight.ttf',
    './fonts/MYRIADPROREGULAR.ttf',
    './images/bg.jpg',
    './service-worker.js',
    './trains.php'
];

self.addEventListener("install", function(event) {
  event.waitUntil(
    caches.open(version + 'trains').then(function(cache) {
        return cache.addAll(offlineTrains);
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

self.addEventListener("activate", function(event) {
  event.waitUntil(
    caches.keys().then(function (keys) {
        return Promise.all(
          keys.filter(function (key) {
              return !key.startsWith(version);
            })
            .map(function (key) {
              return caches.delete(key);
            })
        );
      })
      .then(function() {
        console.log('WORKER: activate completed.');
      })
  );
});