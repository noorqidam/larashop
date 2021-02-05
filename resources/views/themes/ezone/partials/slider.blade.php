@if ($slides)
	<div class="slider-area">
		<div class="slider-active owl-carousel">
			@foreach ($slides as $slide)
			<div class="single-slider-4 slider-height-6 bg-img" style="background-image: url({{ asset('storage/'. $slide->extra_large) }})">
				<div class="container">
					<div class="row">
						<div class="ml-auto col-lg-6">
							<div class="furniture-content fadeinup-animated">
								<h2 class="animated">{!! $slide->title !!}</h2>
								<p class="animated">{{ $slide->body }}</p>
								<a class="furniture-slider-btn btn-hover animated" href="{{ $slide->url }}">Go</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
@endif
