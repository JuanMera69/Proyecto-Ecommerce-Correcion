import './bootstrap'
import { createApp } from 'vue'
import Cart from './components/Cart.vue'
import ProductList from './components/ProductList.vue'
import ProductModal from './components/ProductModal.vue'
import Home from './components/Home.vue'
import vSelect from 'vue-select'

const app = createApp({
	components: {
		Home,
		Cart,
		ProductList,
		ProductModal
	}
})

app.component('v-select', vSelect)
app.mount('#app')
