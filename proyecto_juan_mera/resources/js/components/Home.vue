<script>
	import { ref, onMounted } from "vue";

	export default {
		props: ["categories"],
		setup(props) {},
	};
</script>

<template>
	<div class="container mt-4">
		<div class="row">
			<div v-for="category in categories" :key="category" class="col-12 mb-4">
				<div class="category-section">
					<div class="category-title-wrapper">
						<h2 class="category-title text-center">{{ category.name }}</h2>
					</div>
					<div class="row mt-4">
						<div v-for="product in category.products.slice(0, 5)" :key="product" class="col-md-3 mb-4">
							<div class="card product-card h-100 shadow-sm">
								<a :href="'products/'+product.id" class="text-decoration-none text-dark">
									<div class="card-body">
										<div class="product-image mb-3">
											<template v-if="product.image">
												<img :src="'images/' + product.image" class="img-fluid product-image-border" alt="Imagen por defecto">
											</template>
											<template v-else>
												<img src="../../../public/images/productos_por_defecto.jpg" class="img-fluid product-image-border" alt="Imagen por defecto">
											</template>
										</div>
										<h5 class="product-name">{{ product.name }}</h5>
										<p class="product-price">{{ product.price }}</p>
									</div>
								</a>
							</div>
						</div>
					</div>
					<div class="text-center">
						<a :href="'categories/'+category.id" class="btn btn-outline-primary btn-sm">Ver más productos</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
.category-section {
	margin-bottom: 40px;
}

.category-title-wrapper {
	width: 100%;
	border: 2px solid #007bff;
	border-radius: 6px;
	padding: 6px;
	display: inline-block;
	background-color: #f8f9fa;
}

.category-title {
	font-size: 1.75rem;
	color: #007bff;
	margin: 0;
}

.product-card {
	transition: transform 0.3s ease, box-shadow 0.3s ease;
	border-radius: 16px;
	background-color: #f1f1f1;
}

.product-card:hover {
	transform: translateY(-5px);
	box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.product-image {
	height: 200px;
	display: flex;
	align-items: center;
	justify-content: center;
}

.product-image img {
	max-height: 100%;
	max-width: 100%;
}

.product-image-border {
	border: 2px solid #b1b1b1;
	border-radius: 8px;
	padding: 5px;
	background-color: #ffffff;
}

.product-name {
	font-size: 1.1rem;
	margin-bottom: 10px;
}

.product-price {
	font-size: 1rem;
	color: #28a745;
	font-weight: bold;
}

.btn-outline-primary {
	transition: background-color 0.3s ease, border-color 0.3s ease,
		color 0.3s ease;
}

.btn-outline-primary:hover {
	background-color: #007bff;
	color: #fff;
}
</style>
