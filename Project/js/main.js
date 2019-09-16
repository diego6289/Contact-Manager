$(function() {
  
  // contact form animations
  $('#contact').click(function() {
    $('#addContactForm').fadeToggle();
  })
  $(document).mouseup(function (e) {
    var container = $("#addContactForm");

    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
  	addContactForm.style.display = "none";
  	container.fadeOut(); // Doesn't work.
	}

  });

});



