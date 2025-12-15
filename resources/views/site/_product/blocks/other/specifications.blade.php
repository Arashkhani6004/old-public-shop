<p class="h5 ismb d-flex align-items-center">
	<i class="bi bi-caret-left-fill text-a me-2"></i>
	مشخصات فنی
	"{{@$product->title}}"
</p>
<div class="specifications px-1">
	@if($specifications->count() > 0)
	<div class="table-responsive">
		<table class="table table-borderless table-striped m-0">
			<tbody>
            @if($specifications->count() > 0)
                @foreach($types as $type)
                    @if($type->view == 1)
                        <tr>
                            <th class="w-25 text-b" scope="row">
                                {{$type->title}}
                            </th>
                            <td class="w-75">
                                <ul class="p-0 m-0">
                                    <li class="list-unstyled text-b fw-bolder">
                                        @foreach($product_specifications as $product_specification)
                                            @if($product_specification->product_specification_type_id == $type->id)
                                                {{$product_specification->productSpecificationValue->title}}
                                            @endif
                                        @endforeach
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endif
				@if($bottom_properties->count() > 0)
				<tr>
					<th class="w-25 text-b" scope="row">
						سایر مشخصات
					</th>
					<td class="w-75">
						<ul class="p-0 m-0">
							@foreach($bottom_properties as $bottom_prop)
							<li class="list-unstyled text-b fw-bolder">
								{!! $bottom_prop->description !!}
							</li>
							@endforeach
						</ul>
					</td>
				</tr>
				@endif
			</tbody>
		</table>
	</div>
	@else
	<div class="my-5">
		<lottie-player src="https://assets4.lottiefiles.com/packages/lf20_IMVScC.json" background="transparent"
			speed="1" class="w-25 h-auto mx-auto" loop autoplay></lottie-player>
	</div>
	@endif
</div>
