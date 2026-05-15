/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Основные цвета из вишневой палитры
        'bg-dark': '#120B0E',      // основной фон страницы
        'bg-card': '#24161C',      // фон карточек, шапка, футер
        'accent': '#9E3C5A',       // акцентный цвет (вишневый)
        'accent-hover': '#B85573', // акцент при наведении (светлая вишня)
        'text-primary': '#FFF5F7', // основной текст (розовато-белый)
        'text-secondary': '#F0D9DF', // второстепенный текст (приглушенно-розовый)
        
        // Дополнительные оттенки
        'accent-light': '#B85573',
        'accent-dark': '#8B2E4A',
        'text-muted': 'rgba(255, 245, 247, 0.6)',
        'border-light': 'rgba(255, 245, 247, 0.1)',
        'border-medium': 'rgba(255, 245, 247, 0.2)',
        
        // Статусные цвета
        'success': '#4A7C59',
        'warning': '#D4AF37',
        'error': '#B91C1C',
        
        // Для обратной совместимости (старые названия)
        'white': '#FFF5F7',
        'green': '#24161C',
        'forest': '#9E3C5A',
        'black': '#120B0E',
        
        // Дополнительные оттенки (для обратной совместимости)
        'white-dark': '#F0D9DF',
        'cinza': '#B85573',
        'cinza-light': '#D4A5B5',
        'forest-light': '#B85573',
        'forest-dark': '#8B2E4A',
        'green-light': '#3A2A30',
      },
    },
  },
  plugins: [],
}