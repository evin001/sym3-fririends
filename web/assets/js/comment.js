$(document).ready(function () {
	var commentId = null;

	/**
	 * Handle response from server for text comment.
	 *
	 * @param {object} response Response from server.
	 */
	function handleResponseForComment(response) {
		if ('id' in response) {
			commentId = response['id'];
		}

		alert(response['message']);
	}

	// If javascript enabled, change behavior by default
	$('#save').on('click', function (event) {
		event.preventDefault();

		var commentText = $('#comment_text');
		var sendData = {text: commentText.val(), commentId: commentId};

		if (commentText.val()) {
			// Send request
			$.post(addCommentUrl, sendData, handleResponseForComment, 'json');
		} else {
			commentText.focus();
		}
	});
});