/** Method that sends an XHR Post request with the user submitted data */
function sendEmail(data) {
  // Show loading
  document.getElementById('backdrop').style.display = 'block'
  document.getElementById('modalLoading').style.display = 'block'
  document.getElementById('modalLoading').classList.add('show')

  data = JSON.stringify(data)

  var request = new XMLHttpRequest()

  request.open('POST', '/sendmail.php', true)

  request.onload = function () {
    if (this.status >= 200 && this.status < 400) {
      document.getElementById('backdrop').style.display = 'none'
      document.getElementById('modalLoading').style.display = 'none'
      document.getElementById('modalLoading').classList.remove('show')

      response = JSON.parse(this.response)
      console.log('Response: ' + response.code)

      if (response.code == 250) {
        $('#successModal').modal('show')
      } else {
        $('#failModal').modal('show')
        console.log(response.message)
      }
    } else {
      $('#failModal').modal('show')
      console.log(this.responseText)
    }
  }

  request.onerror = function () {
    $('#failModal').modal('show')
    console.log(this.responseText)
  }

  request.send(data)
}

/** Method that checks if required inputs are filled */
function submitData(form, e) {
  e.preventDefault()

  smtpAdress = document.getElementById('smtpAdress').value
  smtpPort = document.getElementById('smtpPort').value
  smtpUsername = document.getElementById('smtpUsername').value
  smtpPassword = document.getElementById('smtpPassword').value
  vorname = document.getElementById('name').value
  nachname = document.getElementById('nachname').value
  subject = document.getElementById('subject').value
  // from
  email = document.getElementById('email').value
  to_email = document.getElementById('to_email').value
  message = document.getElementById('message').value

  var data = {
    smtpAdress: smtpAdress,
    smtpPort: smtpPort,
    smtpUsername: smtpUsername,
    smtpPassword: smtpPassword,
    vorname: vorname,
    nachname: nachname,
    subject: subject,
    email: email,
    toEmail: to_email,
    message: message,
  }

  sendEmail(data)
}
