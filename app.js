/**
 * @file app.js
 * @brief Главный файл PWA приложения
 * @details Регистрирует Service Worker для оффлайн-работы
 */

/**
 * @brief Регистрирует Service Worker при загрузке страницы
 * @details Проверяет поддержку и регистрирует sw.js
 */
window.addEventListener('load', async () => {
    /**
     * @brief Проверяет поддержку Service Worker в браузере
     */
    if ('serviceWorker' in navigator) {
        try {
            /**
             * @brief Регистрирует Service Worker
             * @param {string} 'sw.js' - путь к файлу Service Worker
             */
            const reg = await navigator.serviceWorker.register('sw.js')
            
            /**
             * @brief Выводит успешную регистрацию в консоль
             */
            console.log('Service worker register success', reg)
        } catch (e) {
            /**
             * @brief Выводит ошибку регистрации в консоль
             */
            console.log('Service worker register fail')
        }
    }
})