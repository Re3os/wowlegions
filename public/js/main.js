function toggleCreateSection(show) {
  if (show)
	  $("#create-topic-section").removeClass("is-hidden")
  else
    $("#create-topic-section").addClass("is-hidden")
}

$(".Dropdown").click(function () {
  if ($(this).hasClass("open"))
      $(this).removeClass("open")
  else
      $(this).addClass("open")
})
