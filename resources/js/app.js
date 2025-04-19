import './bootstrap';
import '../css/app.css';
import 'preline';
import Swal from 'sweetalert2'

// Ensure the external library or component is loaded before calling autoInit
document.addEventListener('livewire:navigated', () => {
    if (window.HSStaticMethod) {
        window.HSStaticMethod.autoInit();
    } else {
        console.error('HSStaticMethod is not defined');
    }
});

window.Swal = Swal;
