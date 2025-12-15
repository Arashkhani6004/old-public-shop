<div class="row w-100 m-0">
	<div class="col-xxl-12 px-1">
        @if(strlen($setting_header->alert) > 1)
		<div class="alert alert-danger alert-dismissible rounded-custom my-1 fade show" role="alert">
			{{@$setting_header->alert}}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
            @endif
	</div>
	<div class="col-xxl-12 p-1">
		<div class="col-xxl-12 p-1" v-for="cartItem in cartItems">

			<div class="card border-0 rounded-custom p-2">
				<div class="row w-100 m-0">
					<div class="col-lg-2 col-sm-4 col-xs-5 align-self-center p-1">
						<a :href="cartItem.productUrl">
							<figure>
								<div class="figure-inn">
									<img :src="cartItem.productImage" :alt="cartItem.productTitle">
								</div>
							</figure>
						</a>
					</div>
					<div class="col-lg-10 col-sm-8 align-self-center p-1">
						<ul class="p-0 m-0">
							<li class="list-unstyled py-1">
								<p class="ismb text-dark h5 my-1">
									@{{ cartItem.productTitle }}
                                    <br>
									@{{ cartItem.productTitleSp }}
								</p>
							</li>
							<li class="list-unstyled py-1">
								<p class="ismb text-secondary h6 my-1">
									<i class="bi bi-tag"></i>
									<span class="me-3">


										@{{ cartItem.itemPrice }} تومان

									</span>
								</p>
							</li>
							<li class="list-unstyled py-1">
								<div class="row w-100 m-0">
									<div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 col-xs-6 align-self-center ps-0 pe-2">
										<div class="input-number-box w-30 ps-1 d-flex">
											<div
												class="qty d-flex align-items-center rounded-0 border position-relative">
												<button  @click="minusQnty(cartItem.id),addToCart2(cartItem.productId,cartItem.productQuantity,false,cartItem.specificationId,cartItem.id)" :disabled="cartItem.productQuantity < 2"
													class="minus btn border border-bottom-0 border-start-0 border-top-0 rounded-0 text-dark bg-one h-100 d-flex align-items-center position-absolute top-0 start-0 bottom-0">
													<i class="bi bi-dash"></i>
												</button>

												<input @change="addToCart2(cartItem.productId,cartItem.productQuantity,false,cartItem.specificationId)" type="number"
													class="count form-control rounded-0 text-center mx-auto"
													id="quantity" name="quantity"
													v-model="cartItem.productQuantity" min="1">


												<button  @click="plusQnty(cartItem.id),addToCart2(cartItem.productId,cartItem.productQuantity,false,cartItem.specificationId,cartItem.id)"
													class="plus btn border border-bottom-0 border-end-0 border-top-0 rounded-0 text-dark bg-one h-100 d-flex align-items-center position-absolute top-0 end-0 bottom-0">
													<i class="bi bi-plus"></i>
												</button>

											</div>
											{{-- <button type="submit" class="btn btn-success rounded-0"
												@click="addToCart2(cartItem.productId,cartItem.productQuantity,false,cartItem.specificationId)"
												style="height: 43px !important;">
												<i class="bi bi-check-circle d-flex"></i>
											</button> --}}
										</div>
									</div>
									<div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-sm-6 col-xs-6 align-self-center ms-auto ps-0 pe-2">
										<a @click="removeCart(cartItem.productId,cartItem.specificationId)" class="m-0 d-flex align-items-center justify-content-center btn btn-outline-danger rounded-0 w-100">
											<i class="bi bi-trash d-flex h5 me-2 my-0"></i>
											حذف
										</a>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
