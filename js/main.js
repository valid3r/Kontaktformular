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

function deleteContact(id) {
  var request = new XMLHttpRequest()

  request.open('POST', 'Controller.php', true)

  request.setRequestHeader(
    'Content-Type',
    'application/x-www-form-urlencoded; charset=UTF-8',
  )

  var data = {
    action: 'delete',
    id: id,
  }

  data = JSON.stringify(data)

  request.send(data)

  window.location.href = '/emails.php'
}

function deleteOlderThan2Weeks() {
  console.log('Delete Older than 2 weeks')

  var request = new XMLHttpRequest()

  request.open('POST', 'Controller.php', true)

  request.setRequestHeader(
    'Content-Type',
    'application/x-www-form-urlencoded; charset=UTF-8',
  )

  var data = {
    action: 'deleteOlderThan2Weeks',
  }

  data = JSON.stringify(data)

  request.send(data)

  window.location.href = '/emails.php'
}

function getContactInfo(id) {
  var request = new XMLHttpRequest()

  request.open('POST', 'Controller.php', true)

  request.setRequestHeader(
    'Content-Type',
    'application/x-www-form-urlencoded; charset=UTF-8',
  )

  const infoModal = new bootstrap.Modal(
    document.getElementById('infoModal'),
    {},
  )

  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log('Response text: ' + this.responseText)

      // Append response to modal
      document.getElementById('info-content').innerHTML = this.responseText

      // Show modal
      infoModal.show()
    }
  }

  var data = {
    action: 'getContactInfo',
    id: id,
  }

  data = JSON.stringify(data)

  request.send(data)
}
