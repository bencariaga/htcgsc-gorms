function onFormSubmit(e) {
	const url = "https://htcgsc-gorms.onrender.com/api/google-forms";
	const itemResponses = e.response.getItemResponses();
	const formData = {};

	for (let i = 0; i < itemResponses.length; i++) {
		const itemResponse = itemResponses[i];
		formData[itemResponse.getItem().getTitle()] =
			itemResponse.getResponse();
	}

	const options = {
		method: "post",
		contentType: "application/json",
		payload: JSON.stringify(formData),
		muteHttpExceptions: true,
	};

	UrlFetchApp.fetch(url, options);
}
