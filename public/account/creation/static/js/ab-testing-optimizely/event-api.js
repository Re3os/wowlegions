// Obtains and injects the Optimizely experiment state into all forms on the page. This will provide a hidden value that
// contains the state of the current (if any) experiment on the backend. Used primarily in conjunction with the Events
// API, that is sent from the backend and requires this data.

(function() {
	$('form').on('submit', function() {
		if (window['optimizely'] && window['optimizely'].get('data')) {
			var optimizelyData = [];
			var state = window['optimizely'].get('state');
			var campaign_data = state.getCampaignStates();
			for (var key in campaign_data) {
				if(!campaign_data.hasOwnProperty(key)) continue;
				var campaign = campaign_data[key];
				if (campaign.id && campaign.experiment && campaign.experiment.id && campaign.variation && campaign.variation.id) {
					var data = {};
					data.campaign_id = campaign.id;
					data.experiment_id = campaign.experiment.id;
					data.variation_id = campaign.variation.id;
					optimizelyData.push(data);
				}
			}

			var input = document.createElement('input');
			input.type = 'hidden';
			input.name = 'optimizelyData';
			input.value = JSON.stringify(optimizelyData);
			for (var form in document.forms) {
				if (document.forms.hasOwnProperty(form)) {
					document.forms[form].appendChild(input);
				}
			}
		}
	})
})();
