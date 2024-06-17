<script>
	import { ref, onMounted } from "vue";
	import ProductModal from "./ProductModal.vue";
	import handlerModal from "@/helpers/HandlerModal.js";
	import {
		successMessage,
		handlerErrors,
		deleteMessage,
	} from "@/helpers/Alerts.js";

	export default {
		components: { ProductModal },
		props: ["products", "categories", "user-role"],
		setup(props) {
			const product = ref(null);
			const { openModal, closeModal, load_modal } = handlerModal();
			onMounted(() => index());

			const index = () => {
				mounteTable();
			};

			const createProduct = async () => {
				product.value = null;
				await openModal("product_modal");
			};

			const editProduct = async (id) => {
				try {
					const { data } = await axios.get(`/products/${id}`);
					product.value = data.product;
					await openModal("product_modal");
				} catch (error) {
					await handlerErrors(error);
				}
			};

			const deleteProduct = async (id) => {
				if (!(await deleteMessage())) return;
				try {
					await axios.delete(`/products/${id}`);
					await successMessage({ is_delete: true });
					reloadState();
				} catch (error) {
					await handlerErrors(error);
				}
			};

			const reloadState = () => {
				window.location.replace("/products");
			};

			const mounteTable = () => {
				$("#product_table").DataTable();
			};

			return {
				product,
				createProduct,
				closeModal,
				load_modal,
				reloadState,
				deleteProduct,
				editProduct,
			};
		},
	};
</script>

<template>
	<div class="card m-5">
		<div class="card-header d-flex justify-content-end">
			<template v-if="userRole.length > 0 && userRole[0].name == 'admin'">
				<button class="btn btn-success" @click="createProduct">Agregar</button>
			</template>
		</div>
		<div class="card-body">
			<div class="table-responsive my-4 mx-2">
				<table class="table table-striped" id="product_table">
					<thead>
						<tr>
							<th>Image</th>
							<th>Name</th>
							<th>Price</th>
							<th>Stock</th>
							<th>Description</th>
							<th>Category</th>
							<template v-if="userRole.length > 0 && userRole[0].name == 'admin'">
								<th>Acciones</th>
							</template>
						</tr>
					</thead>
					<tbody>
						<tr v-for="product in products" :key="product">
							<td>
								<template v-if="product.image">
									<img style="height: 80px; width: 100px; object-fit:cover;" :src="'images/' + product.image" alt="">
								</template>
								<template v-else>
									<img style="height: 80px;" src="../../../public/images/productos_por_defecto.jpg" alt="">
								</template>

							</td>
							<td>{{product.name}}</td>
							<td>{{product.price}}</td>
							<td>{{product.description}}</td>
							<td>{{product.stock}}</td>
							<td>{{product.category.name}}</td>
							<template v-if="userRole.length > 0 && userRole[0].name == 'admin'">
								<td>
									<div class="d-flex justify-content-center gap-2">
										<button type="button" class="btn btn-success" title="Editar" @click="editProduct(product.id)">
											<i class="fas fa-pen"></i>
										</button>
										<button type="button" class="btn btn-danger" title="Eliminar" @click="deleteProduct(product.id)">
											<i class="fas fa-trash"></i>
										</button>
									</div>
								</td>
							</template>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div v-if="load_modal">
		<product-modal :product_data="product" :categories="categories" />
	</div>
</template>

