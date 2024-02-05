require('./bootstrap');

import Alpine from 'alpinejs';


// FlexSlider
import 'flexslider';

// Dropzone
import 'dropzone';

// CKEditor
import  'ckeditor';

// Font Awesome (si estás utilizando un bundler como Webpack)
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
library.add(fas, far, fab);

// Glider.js
import 'glider-js';

// SweetAlert2
import Swal from 'sweetalert2';
window.Swal = Swal;

window.Alpine = Alpine;

Alpine.start();
