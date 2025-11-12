import './bootstrap';
import Alpine from 'alpinejs';

// Impor file Alpine component Anda
import stockChecker from './stock-checker';

// Daftarkan Alpine data
Alpine.data('stockChecker', stockChecker);

window.Alpine = Alpine;
Alpine.start();
