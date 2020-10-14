"use strict";
var ecolife_magnifier_vars;
var yith_magnifier_options = {
		sliderOptions: {
			responsive: ecolife_magnifier_vars.responsive,
			circular: ecolife_magnifier_vars.circular,
			infinite: ecolife_magnifier_vars.infinite,
			direction: 'left',
			debug: false,
			auto: false,
			align: 'left',
			height: 'auto',
			prev    : {
				button  : "#slider-prev",
				key     : "left"
			},
			next    : {
				button  : "#slider-next",
				key     : "right"
			},
			scroll : {
				items     : 1,
				pauseOnHover: true
			},
			items   : {
				visible: Number(ecolife_magnifier_vars.visible),
			},
			swipe : {
				onTouch:    true,
				onMouse:    true
			},
			mousewheel : {
				items: 1
			}
		},
		showTitle: false,
		zoomWidth: ecolife_magnifier_vars.zoomWidth,
		zoomHeight: ecolife_magnifier_vars.zoomHeight,
		position: ecolife_magnifier_vars.position,
		lensOpacity: ecolife_magnifier_vars.lensOpacity,
		softFocus: ecolife_magnifier_vars.softFocus,
		adjustY: 0,
		disableRightClick: false,
		phoneBehavior: ecolife_magnifier_vars.phoneBehavior,
		loadingLabel: ecolife_magnifier_vars.loadingLabel,
	};