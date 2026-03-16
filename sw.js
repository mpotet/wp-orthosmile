/**
 * OrthoSmile - Service Worker
 *
 * Provides basic offline caching for the theme's static assets.
 *
 * @package OrthoSmile
 */

const CACHE_NAME = 'orthosmile-v1';

const CACHED_URLS = [
    '/',
];

// Install: pre-cache shell resources
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => cache.addAll(CACHED_URLS))
    );
    self.skipWaiting();
});

// Activate: remove outdated caches
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) =>
            Promise.all(
                keys
                    .filter((key) => key !== CACHE_NAME)
                    .map((key) => caches.delete(key))
            )
        )
    );
    self.clients.claim();
});

// Fetch: network-first strategy with cache fallback
self.addEventListener('fetch', (event) => {
    // Only handle GET requests for same-origin URLs
    if (event.request.method !== 'GET') {
        return;
    }

    event.respondWith(
        fetch(event.request)
            .then((response) => {
                // Cache a clone of successful responses
                if (response && response.ok) {
                    const responseClone = response.clone();
                    caches.open(CACHE_NAME).then((cache) => {
                        cache.put(event.request, responseClone);
                    });
                }
                return response;
            })
            .catch(() => caches.match(event.request))
    );
});
