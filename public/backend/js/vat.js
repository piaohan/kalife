/**
 * Created by hp on 10/1/2018.
 */

var pageUrl = '/backend/additions';

function toastWarning(message){
  return iziToast.warning({
    timeout: 10000,
    close: true,
    id: 'question',
    title: 'Hey',
    message: message,
    position: 'topRight',
    buttons: [
      ['<button><b>OK</b></button>', function (instance, toast) {

        instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');

      }, true]
    ],
    onClosing: function(instance, toast, closedBy){
      // console.info('Closing | closedBy: ' + closedBy);
    },
    onClosed: function(instance, toast, closedBy){
      console.info('Closed | closedBy: ' + closedBy);
    }
  });
}

function toastSuccess(message){
  return iziToast.success({
    id: 'success',
    timeout: 7000,
    close: true,
    title: 'Success',
    message: message,
    position: 'bottomRight',
    transitionIn: 'bounceInLeft',
    // iconText: 'star',
    onOpened: function(instance, toast){

    },
    onClosed: function(instance, toast, closedBy){
      console.info('closedBy: ' + closedBy);

    }
  });

}

function toastError(message){
  return iziToast.error({
    id: 'error',
    timeout: 7000,
    close: true,
    title: 'Error',
    message: message,
    position: 'topRight',
    transitionIn: 'fadeInDown'
  });
}

function toastInfo(message) {
  return iziToast.info({
    id: 'info',
    timeout: 7000,
    close: true,
    title: 'Hello',
    message: message,
    position: 'topLeft',
    transitionIn: 'bounceInRight'
  });
}

function modalError(message){
  $("#modalError").iziModal({
    title: "Attention",
    close: true,
    subtitle: message,
    icon: 'icon-power_settings_new',
    headerColor: '#BD5B5B',
    width: 600,
    timeout: 10000,
    timeoutProgressbar: true,
    transitionIn: 'fadeInDown',
    transitionOut: 'fadeOutDown',
    pauseOnHover: true
  });
  event.preventDefault();
  return $('#modalError').iziModal('open');
}

function modalSuccess(message){
  $("#modalSuccess").iziModal({
    title: "Success",
    close: true,
    subtitle: message,
    icon: 'icon-power_settings_new',
    headerColor: '#1bbd65',
    width: 600,
    timeout: 10000,
    timeoutProgressbar: true,
    transitionIn: 'fadeInDown',
    transitionOut: 'fadeOutDown',
    pauseOnHover: true
  });
  event.preventDefault();
  return $('#modalSuccess').iziModal('open');
}

function modalInfo(message){
  $("#modalInfo").iziModal({
    title: "Info",
    close: true,
    subtitle: message,
    icon: 'icon-power_settings_new',
    headerColor: '#1bbd65',
    width: 600,
    timeout: 20000,
    timeoutProgressbar: true,
    transitionIn: 'fadeInDown',
    transitionOut: 'fadeOutDown',
    pauseOnHover: true
  });
  event.preventDefault();
  return $('#modalInfo').iziModal('open');
}

function extractError(error) {
  for(var error_log in error.response.data.errors) {
    var err = error.response.data.errors[error_log];
    toastError(err);
  }
}

$(function () {

  $('#save_vat').click(function () {
    var vat_type = $('#vat_type').val();
    var vat_value_type = $('#vat_value_type').val();
    var vat_value = $('#vat_value').val();

    axios.post('/backend/additions/vat', {
      'vat_type': vat_type,
      'vat_value_type': vat_value_type,
      'vat_value': vat_value
    }).then(function (response) {
      if(response.data == 1)
      {
        toastr.success('Vat saved successfully');
        window.location.href = pageUrl+'/vat';
      }
      else
      {
        toastError('Could not save vat');
      }
    }).catch(function (error) {
      extractError(error);
    })
  });

  $('.editVat').click(function(){
    var type = $(this).val();
    axios.get(pageUrl+'/getVat/'+type)
        .then(function(response){
          console.log(response.data);
            $('#vat_type').val(response.data.type);
            $('#vat_value_type').val(response.data.value_type);
            $('#vat_value').val(response.data.value);
            $('#save_vat').text('Edit Vat');
            $('#vat_header').text('Edit Vat');
            toastr.info('Vat information populated');
        })
        .catch(function(error){

        })
  });
});

function fetchVats()
{

}