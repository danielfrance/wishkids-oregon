/**
 * Created by dfrance1 on 8/22/16.
 */
$(document).ready(function () {

  // EqualHeight.findSize();
  // EqualHeight.reSize();

  $('.equal_height').matchHeight({
    byRow: false,
  });
  
  $('.sign_up').on('click', function(event){
    $('.ui.modal.sign_up_form')
        .modal({
          inverted: true
        })
        .modal('show');
    var ID = $(this).attr('id');
    granter_type = $(this).attr('data-text');
    console.log(granter_type);
    
    $('input[name=child]').val(ID);
    $('input[name=granter_type]').val(granter_type);
    
  })

  $('.contactus').on('click', function(event){
    event.preventDefault();
    $('.ui.modal.contact_form')
        .modal({
          inverted: true
        })
        .modal('show');

  })
  
  $('.admin button.button.blue.add').on('click', function(event){
    $('.ui.modal')
        .modal({
          inverted: true
        })
        .modal('show')
  })

  $('.granter_info').on('click', function(event){
    event.preventDefault();
    id = $(this).attr('data-id');
    console.log(id);
    popup = $('.modals').find('div#'+id);

    console.dir(popup);

    $(popup).modal('show');

  })

  $('.delete_button').on('click',  function(event) {
      event.preventDefault();
      $('.ui.modal.delete_modal').modal('show');

      $('.ui.green.close').on('click', function(event) {
        event.preventDefault();
        $('.ui.modal').modal('hide');
      });
    });

});



