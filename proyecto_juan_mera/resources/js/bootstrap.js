import _ from 'lodash'
import * as bootstrap from 'bootstrap'
import axios from 'axios'
import jquery from 'jquery'
import '@fortawesome/fontawesome-free/js/all.js'

import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css'

import 'datatables.net-bs5'
import 'datatables.net-buttons-bs5'
import 'datatables.net-buttons/js/buttons.html5.mjs'

import 'vue-select/dist/vue-select.css'

window.$ = jquery
window._ = _
window.axios = axios
window.bootstrap = bootstrap
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest' // ajax

const csrf_token = document.head.querySelector('meta[name="csrf-token"]')
