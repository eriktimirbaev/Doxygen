/**
 * @file sw.js
 * @brief Service Worker для PWA
 * @details Кэширует ресурсы для оффлайн-работы
 */

/**
 * @brief Имя кэша для статических ресурсов
 * @constant {string}
 */
const staticCacheName = 's-app-v1'

/**
 * @brief Список URL для кэширования
 * @constant {Array<string>}
 */
const assetUrls = [
    'index.html',      ///< Главная страница
    'app.js',          ///< Основной скрипт
    'css/style.css'    ///< Стили
]

/**
 * @brief Событие установки Service Worker
 * @details Кэширует указанные ресурсы при установке
 */
self.addEventListener('install', async event => {
    /**
     * @brief Открывает кэш с заданным именем
     */
    const cache = await caches.open(staticCacheName)
    
    /**
     * @brief Добавляет все ресурсы в кэш
     */
    await cache.addAll(assetUrls)
})

/**
 * @brief Событие активации Service Worker
 * @details Выполняется после установки
 */
self.addEventListener('activate', event => {
    /**
     * @brief Логирует активацию в консоль
     */
    console.log('[SW]: activate')
})

/**
 * @brief Событие fetch (запрос ресурса)
 * @details Перехватывает сетевые запросы
 */
self.addEventListener('fetch', event => {
    /**
     * @brief Логирует URL запроса
     */
    console.log('Fetch', event.request.url)
    
    /**
     * @brief Использует стратегию "Cache First"
     */
    event.respondWith(cacheFirst(event.request))
})

/**
 * @brief Стратегия кэширования "Cache First"
 * @details Сначала проверяет кэш, затем сеть
 * @param {Request} request - объект запроса
 * @returns {Promise<Response>} - ответ из кэша или сети
 */
async function cacheFirst(request) {
    /**
     * @brief Ищет ответ в кэше
     */
    const cached = await caches.match(request)
    
    /**
     * @brief Возвращает из кэша или запрашивает из сети
     */
    return cached ?? await fetch(request)
}