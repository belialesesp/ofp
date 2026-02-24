(function($) {
  $(".expand-list-destinantion-button").click(function () {
    const target = $(this).attr('target')
    $(`.${target}`).slideToggle(300)
  });

  $('.select-destination').change(function(){
    const target = $(this).val()
    window.location = target
  })
})(jQuery);
