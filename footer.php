  <div classs="container p-5">
	<div class="row no-gutters fixed-bottom">
		<div id="alert-wrapper" class="col-lg-5 col-md-12 m-auto">
		</div>
	</div>
</div>

<script>

const alertPlaceholder = document.getElementById('alert-wrapper')

const alert = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
}

const alertTrigger = document.getElementById('liveAlertBtn')
if (alertTrigger) {
  alertTrigger.addEventListener('click', () => {
    alert('Nice, you triggered this alert message!', 'success')
  })
}
</script>

<div class="mt-5">

  <footer class="bg-light text-center">
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    Simple CMS, by
    <a class="text-black" href="https://suntoes.codes/" target="_blank">suntoes</a>
  </div>
</footer>
  
</div>
</div>
</body>
</html>
