document.getElementById('generate-btn').addEventListener('click', function() {
    var text = document.getElementById('text-input').value;
    var expiryTime = document.getElementById('expiry-time').value;
    var option = document.getElementById('exampleFormControlSelect1').value;
  
    if (option && expiryTime) {
      var currentTime = new Date();
      var selectedTime = new Date(expiryTime);
  
      if (selectedTime <= currentTime) {
        alert('La fecha de expiración debe ser posterior a la fecha actual.');
        return;
      }
  
      var timeDifference = selectedTime - currentTime;
      var minutesDifference = Math.floor(timeDifference / (1000 * 60));
      var hoursDifference = Math.floor(minutesDifference / 60);
  
      if (minutesDifference < 30) {
        alert('La fecha de expiración debe ser al menos 30 minutos en el futuro.');
        return;
      }
  
      var message = generateMessage(option, text, expiryTime);
      var qrCode = generateQRCode(message, expiryTime);
      document.getElementById('qrcode-container').innerHTML = '';
      document.getElementById('qrcode-container').appendChild(qrCode);
    }
  });
  
  function generateMessage(option, text, expiryTime) {
    var message = '';
    var expirationDate = new Date(expiryTime);
  
    switch (option) {
      case '1':
        message = 'Tipo de visitante: Familia';
        break;
      case '2':
        message = 'Tipo de visitante: Repartidor';
        break;
      case '3':
        message = 'Tipo de visitante: Repartidor de Comida';
        break;
      case '4':
        message = 'Tipo de visitante: Amigo/Familia';
        break;
      case '5':
        message = 'Tipo de visitante: Salida Rápida';
        break;
      default:
        message = 'Tipo de visitante: Desconocido';
        break;
    }
  
    if (text) {
      message += '\nTexto/Mensaje: ' + text;
    }
  
    if (expirationDate instanceof Date && !isNaN(expirationDate)) {
      message += '\nFecha de expiración: ' + expirationDate.toLocaleString();
    }
  
    return message;
  }
  
  function generateQRCode(text, expiryTime) {
    var qrCode = document.createElement('img');
    qrCode.src = 'https://api.qrserver.com/v1/create-qr-code/?data=' + encodeURIComponent(text);
  
    if (expiryTime) {
      var currentTime = new Date();
      var selectedTime = new Date(expiryTime);
  
      if (selectedTime > currentTime) {
        var timeDifference = selectedTime - currentTime;
        setTimeout(function() {
          qrCode.remove();
        }, timeDifference);
      }
    }
  
    return qrCode;
  }
  