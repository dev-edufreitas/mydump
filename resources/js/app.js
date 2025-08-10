import './bootstrap';
import Quill from 'quill';
import 'quill/dist/quill.snow.css'; // Estilo do editor

document.addEventListener("DOMContentLoaded", () => {
    const editor = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link']
            ]
        }
    });
});
