<?php
$background_color = get_field('background_color') ?: '#000';
?>

<section class="calculator max-w-72" style="background: <?php echo esc_attr($background_color); ?>;">
	<div class="grid grid-cols-4 grid-rows-5 gap-4 px-4 py-8">
		<div class="col-span-4">
			<div class="calculator-screen text-right text-white text-3xl" id="calculator-screen">0</div>
		</div>
		<div class="col-span-4 row-start-2 text-right">
			<div class="calculator-screen text-right text-white" id="calculator-screen-result">0</div>
		</div>
		<div class="row-start-3 text-center">
			<button id="clear" class="rounded-full bg-slate-600 h-14 w-14 text-red-500">C</button>
		</div>
		<div class="row-start-3 col-start-4 text-center">
			<button class="operator rounded-full bg-slate-600 h-14 w-14 text-red-200" data-operator="divide">/</button>
		</div>
		<div class="row-start-4 text-center">
			<button class="number rounded-full bg-slate-600 h-14 w-14 text-white" data-number="7">7</button>
		</div>
		<div class="row-start-4 text-center">
			<button class="number rounded-full bg-slate-600 h-14 w-14 text-white" data-number="8">8</button>
		</div>
		<div class="row-start-4 text-center">
			<button class="number rounded-full bg-slate-600 h-14 w-14 text-white" data-number="9">9</button>
		</div>
		<div class="row-start-4 text-center">
			<button class="operator rounded-full bg-slate-600 h-14 w-14 text-red-200" data-operator="multiply">x</button>
		</div>
		<div class="row-start-5 text-center">
			<button class="number rounded-full bg-slate-600 h-14 w-14 text-white" data-number="4">4</button>
		</div>
		<div class="row-start-5 text-center">
			<button class="number rounded-full bg-slate-600 h-14 w-14 text-white" data-number="5">5</button>
		</div>
		<div class="row-start-5 text-center">
			<button class="number rounded-full bg-slate-600 h-14 w-14 text-white" data-number="6">6</button>
		</div>
		<div class="row-start-5 text-center">
			<button class="operator rounded-full bg-slate-600 h-14 w-14 text-red-200" data-operator="subtract">-</button>
		</div>
		<div class="row-start-6 text-center">
			<button class="number rounded-full bg-slate-600 h-14 w-14 text-white" data-number="1">1</button>
		</div>
		<div class="row-start-6 text-center">
			<button class="number rounded-full bg-slate-600 h-14 w-14 text-white" data-number="2">2</button>
		</div>
		<div class="row-start-6 text-center">
			<button class="number rounded-full bg-slate-600 h-14 w-14 text-white" data-number="3">3</button>
		</div>
		<div class="row-start-6 text-center">
			<button class="operator rounded-full bg-slate-600 h-14 w-14 text-red-200" data-operator="add">+</button>
		</div>
		<div class="row-start-7 col-start-2 text-center">
			<button class="number rounded-full bg-slate-600 h-14 w-14 text-white" data-number="0">0</button>
		</div>
		<div class="row-start-7 col-start-4 text-center">
			<button class="equal-sign rounded-full bg-stone-500 h-14 w-14 text-white" id="equal-sign">=</button>
		</div>
		<div class="row-start-8 col-start-4 text-center">
			<button class="rounded-full bg-lime-600 h-14 w-14 text-white" id="save-calculation">save</button>
		</div>
	</div>
</section>
