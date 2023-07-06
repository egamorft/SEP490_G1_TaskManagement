/*=========================================================================================
    File Name: dashboard-ecommerce.js
    Description: dashboard ecommerce page content with Apexchart Examples
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(window).on("load", function () {
    "use strict";

	function debounce(fn, delay = 300) {
		var timeoutID = null;

		return function () {
			clearTimeout(timeoutID);

			var args = arguments;
			var that = this;

			timeoutID = setTimeout(function () {
				fn.apply(that, args);
			}, delay);
		}
	};

	// this is where we integrate the v-debounce directive!
	// We can add it globally (like now) or locally!
	Vue.directive('debounce', (el, binding) => {
		if (binding.value !== binding.oldValue) {
			// window.debounce is our global function what we defined at the very top!
			el.oninput = debounce(ev => {
				el.dispatchEvent(new Event('change'));
			}, parseInt(binding.value) || 300);
		}
	});

	new Vue({
		el: '#app',
		data() {
			return {
				keywords: null,
				posts: [
					{id: 1, title: 'Front-end Performance – Where should we start?'},
					{id: 2, title: 'Vue Calendar Component with Laravel API'},
					{id: 3, title: 'Optimise Your Front-end Workflow with Prepros'},
					{id: 4, title: 'Affinity Designer vs. Adobe Illustrator – Which One is Better for You?'},
					{id: 5, title: 'Implementing Laravel’s Authorization on the Front-End'},
					{id: 6, title: 'Using CodePen Can Boost Your Front-end Development Workflow'},
					{id: 7, title: 'Connecting GitLab, Codeship and Laravel Forge'},
					{id: 8, title: 'Dynamic Author Email with Contact Form 7'},
					{id: 9, title: 'Impersonating Users in Laravel'},
					{id: 10, title: 'Introduction to Affinity Designer'},
					{id: 11, title: 'Using Contenteditable Attribute'},
					{id: 12, title: 'Using Laravel’s Localization in JS'},
					{id: 13, title: 'CSS Gradient Basics'},
				]
			}
		},
		computed: {
			results() {
				return this.keywords ? this.posts.filter(result => result.title.includes(this.keywords)) : [];
			}
		},
		methods: {
			highlight(text) {
				return text.replace(new RegExp(this.keywords, 'gi'), '<span class="highlighted">$&</span>');
			}
		}
	})
});
