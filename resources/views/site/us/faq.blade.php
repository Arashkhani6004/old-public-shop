@extends('layouts.site.master')
@section('content')

<main class="content">
	<div class="rules">
		<div class="bg-b-light py-3">
			<div class="container">
				<div class="row w-100 m-0">
					<div class="col-sm-12 p-1 px-xs-2">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="/">
										خانه
									</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">
                                    سوالات متداول
                                </li>
							</ol>
						</nav>
					</div>
					<div class="col-sm-12 p-0">
						<div class="row w-100 m-0">

							<div class="col-xxl-12 p-1">
								<div class="bg-white product-details-header p-md-4 p-sm-3 p-xs-1">
									<div class="bg-l p-2 rounded-custom">
										<div class="row m-0 w-100">
											<div class="col-md-12 p-1">
												<p class="ismb mb-1">
													سوالات کاربران
												</p>
											</div>
											<div class="col-md-12 p-0">
												<div class="accordion" id="accordionFaqPage">
													<div class="accordion-item">
														<h2 class="accordion-header" id="heading1">
															<button class="accordion-button"
																type="button" data-bs-toggle="collapse"
																data-bs-target="#collapse1"
																aria-expanded="true"
																aria-controls="collapse1">
																<div class="">
																	<p class="fw-bolder h5 mb-2">
																		1 - عنوان سوال شماره یک
																	</p>
																	<p class="h6 mb-0 mt-2">
																		متن سوال آزمایشی شماره یک
																	</p>
																</div>
															</button>
														</h2>
														<div id="collapse1"
															class="accordion-collapse collapse show"
															aria-labelledby="heading1"
															data-bs-parent="#accordionFaqPage">
															<div
																class="accordion-body text-justify text-secondary">
																لورم ایپسوم متن ساختگی با تولید سادگی
																نامفهوم از صنعت چاپ و با استفاده
																از طراحان گرافیک است. چاپگرها و متون
																بلکه روزنامه و مجله در ستون و
																سطرآنچنان که لازم است و برای شرایط فعلی
																تکنولوژی مورد نیاز و کاربردهای
																متنوع با هدف بهبود ابزارهای کاربردی می
																باشد. کتابهای زیادی در شصت و سه
																درصد گذشته، حال و آینده شناخت فراوان
																جامعه و متخصصان را می طلبد تا با
																نرم افزارها شناخت بیشتری را برای طراحان
																رایانه ای علی الخصوص طراحان
																خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد
																کرد. در این صورت می توان امید
																داشت که تمام و دشواری موجود در ارائه
																راهکارها و شرایط سخت تایپ به
																پایان رسد وزمان مورد نیاز شامل حروفچینی
																دستاوردهای اصلی و جوابگوی
																سوالات پیوسته اهل دنیای موجود طراحی
																اساسا مورد استفاده قرار گیرد.
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

@stop
